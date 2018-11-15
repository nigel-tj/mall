<?php

namespace MigrateUsers;

/**
 * Class Table
 * @package MigrateUsers
 */
class Table extends \WP_List_Table
{
    /**
     * @var MigrateUsers
     */
    protected $migrateUsers;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $defaults;

    /**
     * @var array
     */
    protected $mapping;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Table constructor.
     * @param MigrateUsers $migrateUsers
     */
    public function __construct(MigrateUsers $migrateUsers)
    {
        $this->migrateUsers = $migrateUsers;

        parent::__construct(array(
            'singular' => 'import',
            'plural' => 'import',
            'ajax' => false,
        ));
    }

    /**
     * @param $item
     * @param string $column_name
     * @return string
     */
    protected function column_default($item, $column_name)
    {
        if ('___actions' === $column_name) {
            return '<input type=checkbox name="ids[]" value="' . $item['___id'] . '">';
        }

        if (isset($this->defaults['text'][$column_name])) {
            return $this->defaults['text'][$column_name];
        }

        if (isset($this->defaults['file'][$column_name])) {
            return $item[$this->defaults['file'][$column_name]];
        }

        if (isset($this->defaults['custom'][$column_name])) {
            return $this->defaults['custom'][$column_name];
        }

        if ('___status' === $column_name) {
            $return = '<span class="status">';
            $return .= $this->migrateUsers->getLogger()->getStatus($item['___id']);

            $log = $this->migrateUsers->getLogger()->getLog($item['___id']);

            if ($log) {
                $return .= '<div class="log">' . implode($this->migrateUsers->getLogger()->getLog($item['___id']),
                        '<br>') . '</div>';
            }

            $return .= '</span>';

            return $return;
        }

        return isset($item[$column_name]) ? $item[$column_name] : '';
    }

    /**
     * @return array
     */
    public function get_columns()
    {
        $columns = array(
            '___actions' => '<input type="checkbox" class="check_all">',
        );

        foreach ($this->mapping as $key => $value) {
            if (!empty($value)) {
                $columns[$key] = $value;
            }
        }

        if (isset($this->defaults['text'])) {
            foreach ($this->defaults['text'] as $key => $value) {
                $columns[$key] = $key;
            }
        }

        if (isset($this->defaults['file'])) {
            foreach ($this->defaults['file'] as $key => $value) {
                $columns[$key] = $key;
            }
        }

        if (isset($this->defaults['custom'])) {
            foreach ($this->defaults['custom'] as $key => $value) {
                $columns[$key] = $key;
            }
        }

        $columns['___status'] = 'Status';

        return $columns;
    }

    /**
     * @return array
     */
    protected function get_bulk_actions()
    {
        $actions = array(
            'import' => 'Import',
            'clear' => 'Clear status',
        );

        return $actions;
    }

    /**
     *
     */
    protected function process_bulk_action()
    {
        if (empty($_POST['ids'])) {
            return;
        }

        if ('clear' === $this->current_action()) {
            $this->migrateUsers->clearStatus($_POST['ids']);
        }

        if ('import' === $this->current_action()) {
            $this->migrateUsers->importUsers($_POST['ids']);
        }
    }

    /**
     * @return string|null
     */
    public function current_action()
    {
        if (isset($_POST['action']) && -1 != $_POST['action']) {
            return $_POST['action'];
        }

        return null;
    }

    /**
     *
     */
    public function prepare_items()
    {
        $per_page = $this->migrateUsers->getOption('limit', 10);
        $this->data = $this->migrateUsers->getData();
        $this->defaults = $this->migrateUsers->getOption('defaults');
        $this->mapping = $this->migrateUsers->getOption('mapping', array());

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action();

        if ($this->migrateUsers->getOption('first_line')) {
            unset($this->data[0]);
        }

        $current_page = $this->get_pagenum();
        $total_items = count($this->data);
        $this->data = array_slice($this->data, ($current_page - 1) * $per_page, $per_page);
        $this->items = $this->data;

        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page)
        ));
    }
}