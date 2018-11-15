<?php

namespace MigrateUsers;

/**
 * Class MigrateUsers
 * @package MigrateUsers
 */
class MigrateUsers
{
    /**
     * @var string
     */
    protected static $key = 'migrate_users';

    /**
     * @var string
     */
    protected static $upload_file_name = 'migrate_users_upload';

    /**
     * @var array|string
     */
    protected static $upload_dir = 'migrate_users';

    /**
     * @var string
     */
    protected static $filename = 'migrate_users.csv';

    /**
     * @var string
     */
    protected static $basename;

    /**
     * @var string
     */
    protected static $plugin_dir;

    /**
     * @var string
     */
    protected static $plugin_dir_url;

    /**
     * @var
     */
    protected static $wp_upload_dir;

    /**
     * @var bool
     */
    protected $file_exists;

    /**
     * @var array
     */
    protected $messages = array();

    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Table;
     */
    protected $table;

    /**
     * MigrateUsers constructor.
     *
     * @param $plugin
     */
    public function __construct($plugin)
    {
        static::$basename = basename($plugin);
        static::$plugin_dir = plugin_dir_path($plugin);
        static::$plugin_dir_url = plugin_dir_url($plugin);
        static::$wp_upload_dir = wp_upload_dir();

        add_action('admin_enqueue_scripts', function () {
            wp_register_style(static::$key, static::$plugin_dir_url . '/assets/css/styles.css');
        });
        add_action('plugins_loaded', function () {
            load_plugin_textdomain(static::$key, false, static::$plugin_dir . '/languages/');
        });
        add_action('admin_menu', function () {
            add_submenu_page('tools.php', __('Migrate Users', static::$key), __('Migrate Users', static::$key),
                'manage_options', static::$key,
                array($this, 'init'));
        });
    }

    /**
     * @return string
     */
    public static function getKey()
    {
        return self::$key;
    }

    /**
     * @return string
     */
    public static function getUploadFileName()
    {
        return self::$upload_file_name;
    }

    /**
     * @return array|string
     */
    public static function getUploadDir()
    {
        return self::$upload_dir;
    }

    /**
     * @return string
     */
    public static function getFilename()
    {
        return self::$filename;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     *
     */
    public function init()
    {
        wp_enqueue_style(static::$key);

        $this->logger = new Logger($this);
        $this->table = new Table($this);

        $this
            ->checkPost()
            ->checkUploadDir()
            ->checkFile()
            ->getOptions()
            ->readCsv()
            ->prepareData();

        $this->renderPage();
    }

    /**
     *
     * @return self
     */
    protected function checkUploadDir()
    {
        if (!file_exists($this->getDirPath())) {
            if (!mkdir($this->getDirPath())) {
                $this->message('Upload directory created successfully');
            } else {
                $this->message('Upload directory do not created. Please, check permissions.');
            }
        }

        return $this;
    }

    /**
     *
     * @return self
     */
    protected function checkFile()
    {
        if (file_exists($this->getFilePath())) {
            $this->file_exists = true;
        } else {
            $this->message('File does not exists.');
            $this->file_exists = false;
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    protected function checkPost()
    {
        if (isset($_FILES[static::$upload_file_name])) {
            $this->uploadFile($_FILES[static::$upload_file_name]);
        }

        if (isset($_POST['options'])) {
            $this->setOptions($_POST['options']);
        }

        if (isset($_POST['clear']) && $_POST['clear'] === 1) {
            $this->clear();
        }

        return $this;
    }

    /**
     *
     * @return string
     */
    protected function getMessages()
    {
        $return = '';

        if (empty($this->messages)) {
            return $return;
        }

        foreach ($this->messages as $message) {
            $message = __($message, static::$key);
            $return .= "<div class=\"notice is-dismissible\"><p>{$message}</p></div>";
        }

        return $return;
    }

    /**
     * @param array $file
     * @return $this
     */
    protected function uploadFile(array $file)
    {
        if (!$file) {
            return $this;
        }

        if (empty($file['name'])) {
            $this->message('Please select the file');
            return $this;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($ext !== 'csv') {
            $this->message('Current extension is not allowed. Please use .csv file');
            return $this;
        }

        if (!move_uploaded_file($file['tmp_name'], $this->getFilePath())) {
            $this->message('File can not be uploaded');
            $this->file_exists = false;
        } else {
            $this->message('File upload successful');
            $this->file_exists = true;
        }

        return $this;
    }

    /**
     * Add message to queue
     *
     * @param $str
     * @return $this
     */
    protected function message($str)
    {
        $this->messages[] = $str;

        return $this;
    }

    /**
     *
     * @return $this
     */
    protected function readCsv()
    {
        if (!$this->file_exists) {
            return $this;
        }

        $row = 0;
        $delimiter = $this->getOption('delimiter', ',');

        if (($handle = fopen($this->getFilePath(), 'rb')) !== false) {
            while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $num = count($data);
                for ($c = 0; $c < $num; $c++) {
                    $this->data[$row][] = $data[$c];
                }
                $row++;
            }
            fclose($handle);
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    protected function prepareData()
    {
        if (empty($this->data)) {
            return $this;
        }

        $id = 0;

        foreach ($this->data as &$data) {
            $data['___id'] = $id;
            $data['___status'] = $this->logger->getStatus($id);
            $id++;
        }

        return $this;
    }


    /**
     *
     * @param $id
     */
    protected function importUser($id)
    {
        try {
            $mapping = $this->getOption('mapping', array());
            $defaults = $this->getOption('defaults');

            $line = $this->getLine($id);
            $log = array();
            $import = array();

            if (!$line) {
                $log[] = __('User not found in the import file. Break.');
                $this->logger->setStatus($id, Logger::ERROR, $log);
                return;
            }

            if (empty($mapping)) {
                $log[] = __('Mapping not set. Break.');
                $this->logger->setStatus($id, Logger::ERROR, $log);
                return;
            }

            $mapping = array_flip($mapping);

            foreach ($mapping as $key => $value) {
                if (!empty($key)) {
                    $import[$key] = $line[$value];
                }

            }

            if (!empty($defaults['text'])) {
                foreach ($defaults['text'] as $key => $value) {

                    if (isset($import[$key])) {
                        $log[] = __('Field ' . $key . ' was override from defaults values as text. Value = ' . $value);
                    }

                    $import[$key] = $value;
                }
            }

            if (!empty($defaults['file'])) {
                foreach ($defaults['file'] as $key => $value) {

                    if (isset($import[$key])) {
                        $log[] = __('Field ' . $key . ' was override from defaults from imports file. Value = ' . $value);
                    }

                    $import[$key] = $line[$value];
                }
            }

            if (!empty($defaults['custom'])) {
                foreach ($defaults['custom'] as $key => $value) {
                    if (isset($import[$key])) {
                        $log[] = __('Field ' . $key . ' was override from defaults as custom. Value = ' . $value);
                    }

                    $import[$key] = $value;
                }
            }

            if (empty($import['user_email'])) {
                $log[] = __('No email field. Break.');
                $this->logger->setStatus($id, Logger::ERROR, $log);
                return;
            }

            if (!filter_var($import['user_email'], FILTER_VALIDATE_EMAIL)) {
                $log[] = __('Email is invalid. Break.');
                $this->logger->setStatus($id, Logger::ERROR, $log);
                return;
            }

            if (empty($import['user_login'])) {
                $log[] = __('Login was created from email field. Value = ' . $import['user_email']);
                $import['user_login'] = $import['user_email'];
            }

            if (empty($import['user_pass'])) {
                $log[] = __('Password was generated.');
                $import['user_pass'] = wp_generate_password($length = 12, $include_standard_special_chars = false);
            }

            foreach ($import as $key => $value) {
                $filtered_value = apply_filters(static::$key . '_' . $key, $value);

                if ($filtered_value !== $value) {
                    $log[] = __('Field with key ' . $key . ' was changed to new value ' . $filtered_value);
                }

                $import[$key] = $filtered_value;
            }

            $user_id = username_exists($import['user_login']);

            if (!$user_id && email_exists($import['user_email']) === false) {
                $user_id = wp_insert_user($import);

                if ($user_id instanceof \WP_Error) {
                    foreach ($user_id->errors as $value) {
                        $log[] = $value[0];
                    }

                    $this->logger->setStatus($id, Logger::ERROR, $log);
                    return;
                }

                $log[] = __('User was created with ID ' . $user_id);

                unset($import['user_email'], $import['user_login'], $import['user_pass'], $import['nickname'], $import['first_name'], $import['last_name'], $import['display_name'], $import['description'], $import['rich_editing'], $import['comment_shortcuts'], $import['admin_color'], $import['use_ssl'], $import['user_registered'], $import['show_admin_bar_front'], $import['locale']);

                if (is_array($import)) {
                    foreach ($import as $key => $value) {
                        update_user_meta($user_id, $key, $value);
                    }

                    $log[] = __('Meta fields updated');
                }

                do_action('migrate_users_success', $user_id, $import);

                $this->logger->setStatus($id, Logger::SUCCESS, $log);
                return;
            }

            $log[] = __('User already exists. Skip.');

            $this->logger->setStatus($id, Logger::NOTICE, $log);

        } catch (\Exception $e) {
            $this->logger->setStatus($id, Logger::ERROR, $e->getMessage());
        }
    }

    /**
     *
     * @param array $ids
     */
    public function importUsers(array $ids)
    {
        foreach ($ids as $id) {
            $this->importUser($id);
        }

        $this->prepareData();
    }

    /**
     *
     * @param array $ids
     */
    public function clearStatus(array $ids)
    {
        foreach ($ids as $id) {
            $this->logger->setStatus($id, null);
        }

        $this->prepareData();
    }

    /**
     *
     * @param array $post
     * @return $this
     */
    protected function setOptions(array $post)
    {
        update_option(static::$key, $post);

        $this->message('Options saved');
        $this->getOptions();

        return $this;
    }

    /**
     *
     */
    protected function clear()
    {
        unlink($this->getFilePath());
        $this->logger->clear();
        $this->message('File and logs were deleted');

        return $this;
    }

    /**
     * @return array
     */
    protected function getUserFields()
    {
        $return = array(
            'id',
            'user_login',
            'user_pass',
            'user_email',
            'role',
            'display_name',
        );

        $meta = get_user_meta(get_current_user_id());

        if (is_array($meta)) {
            foreach ($meta as $key => $value) {
                $return[] = $key;
            }
        }

        return $return;
    }

    /**
     * @return self
     */
    protected function getOptions()
    {
        $this->options = get_option(static::$key);

        if (empty($this->options)) {
            $this->message('Please set your options');
        }

        return $this;
    }

    /**
     *
     * @param $name
     * @param mixed|$default Will be returned when value not set
     * @return mixed|null
     */
    public function getOption($name, $default = null)
    {
        foreach ($this->options as $key => $value) {
            if ($key === $name) {
                return $value;
            }
        }

        if ($default) {
            return $default;
        }

        return null;
    }

    /**
     *
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     *
     * @param $id
     * @return mixed|null
     */
    protected function getLine($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }

    /**
     *
     * @return string
     */
    protected function getDirPath()
    {
        return static::$wp_upload_dir['basedir'] . '/' . static::$upload_dir . '/';
    }

    /**
     *
     * @return string
     */
    protected function getFilePath()
    {
        return $this->getDirPath() . static::$filename;
    }

    /**
     *
     * @return array
     */
    protected function getDefaultsText()
    {
        return !empty($this->getOption('defaults')['text']) ? $this->getOption('defaults')['text'] : array();
    }

    /**
     *
     * @return array
     */
    protected function getDefaultsFile()
    {
        return !empty($this->getOption('defaults')['file']) ? $this->getOption('defaults')['file'] : array();
    }

    /**
     *
     * @return array
     */
    protected function getDefaultsCustom()
    {
        return !empty($this->getOption('defaults')['custom']) ? $this->getOption('defaults')['custom'] : array();
    }

    /**
     * @param int $id
     * @return array
     */
    protected function getFields($id = 0)
    {
        $return = !empty($this->data[$id]) ? $this->data[$id] : array();

        unset($return['___id'], $return['___status']);

        return $return;
    }

    /**
     * @return string
     */
    protected function getCurrentAction()
    {
        return isset($_GET['action']) ? (string)$_GET['action'] : 'index';
    }

    /**
     *
     */
    public function renderPage()
    {
        $data['key'] = static::$key;
        $data['messages'] = $this->getMessages();
        $data['action'] = $this->getCurrentAction();
        $data['file_exists'] = $this->file_exists;
        $data['upload_file_name'] = static::$upload_file_name;
        $data['options'] = [
            'delimiter' => $this->getOption('delimiter', ','),
            'update' => $this->getOption('update', false),
            'reset' => $this->getOption('reset', false),
            'first_line' => $this->getOption('first_line', false),
            'logs' => $this->getOption('logs', false),
            'limit' => $this->getOption('limit', 10),
            'mapping' => $this->options['mapping']
        ];

        $data['fields'] = $this->getFields();
        $data['user_fields'] = $this->getUserFields();
        $data['defaults'] = [
            'text' => $this->getDefaultsText(),
            'file' => $this->getDefaultsFile(),
            'custom' => $this->getDefaultsCustom(),
        ];
        $data['table'] = $this->table;

        include static::$plugin_dir . '/templates/options.php';
    }
}