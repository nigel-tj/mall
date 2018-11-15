<div class="migrate_users">

    <?php echo $data['messages']; ?>

    <ul class="menu">
        <li class="<?php echo ('upload' === $data['action']) ? 'active' : ''; ?>"><a
                    href="?page=migrate_users&action=upload">1. <?php _e('Upload file', $data['key']); ?></a>
        </li>
        <li class="<?php echo ('options' === $data['action']) ? 'active' : ''; ?>"><a
                    href="?page=migrate_users&action=options">2. <?php _e('Set options', $data['key']); ?></a>
        </li>
        <li class="<?php echo ('import' === $data['action']) ? 'active' : ''; ?>"><a
                    href="?page=migrate_users&action=import">3. <?php _e('Import users', $data['key']); ?></a>
        </li>
        <li class="<?php echo ('clear' === $data['action']) ? 'active' : ''; ?>"><a
                    href="?page=migrate_users&action=clear">4. <?php _e('Delete file', $data['key']); ?></a>
        </li>
    </ul>
    <div class="content">
        <?php
        switch ($data['action']) {
            case 'upload':
                ?>
                <h3><?php _e('Upload file', $data['key']); ?></h3>

                <p><?php
                    if ($data['file_exists']) {
                        _e('File already uploaded. This action will rewrite the file.', $data['key']);
                    }
                    ?>
                </p>
                <p><?php _e('Allowed only .csv files', $data['key']); ?></p>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="<?php echo $data['upload_file_name']; ?>">
                    <input type="submit" class="button button-primary"
                           value="<?php _e('Upload file', $data['key']); ?>">
                </form>
                <?php
                break;
            case 'options':
                ?>
                <h3><?php _e('Options', $data['key']); ?></h3>
                <form method="post">
                    <table class="options">
                        <tr>
                            <td class="name">
                                <label for="options_delimiter"><?php _e('Delimiter', $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_delimiter" type="text" name="options[delimiter]"
                                       value="<?php echo $data['options']['delimiter']; ?>">
                            </td>
                            <td class="info">
                                <?php _e('Most commonly used ";" or ",". After changing please save options to see changes',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">
                                <label for="options_update"><?php _e('Update exiting', $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_update" type="checkbox" name="options[update]" value="1"
                                    <?php echo $data['options']['update'] ? 'checked' : ''; ?>>
                            </td>
                            <td class="info">
                                <?php _e('Should existing users be updated or always create new',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">
                                <label for="options_reset"><?php _e('Send reset password link',
                                        $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_reset" type="checkbox" name="options[reset]" value="1"
                                    <?php echo $data['options']['reset'] ? 'checked' : ''; ?>>
                            </td>
                            <td class="info">
                                <?php _e('Send email with reset password link to the new users after import',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">
                                <label for="options_first_line"><?php _e('First line contain the fields names',
                                        $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_first_line" type="checkbox" name="options[first_line]"
                                       value="1"
                                    <?php echo $data['options']['first_line'] ? 'checked' : ''; ?>>
                            </td>
                            <td class="info">
                                <?php _e('Check this option if the file has fields names in first line',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">
                                <label for="options_logs"><?php _e('Write logs', $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_logs" type="checkbox" name="options[logs]"
                                       value="1"
                                    <?php echo $data['options']['logs'] ? 'checked' : ''; ?>>
                            </td>
                            <td class="info">
                                <?php _e('Write more info about import process', $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">
                                <label for="options_limit"><?php _e('Limit rows on page',
                                        $data['key']); ?></label>
                            </td>
                            <td class="value">
                                <input id="options_limit" type="number" name="options[limit]"
                                       value="<?php echo $data['options']['limit']; ?>">
                            </td>
                            <td class="info">
                                <?php _e('Check this option if the file has fields names in first line',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3><?php _e('Mapping fields from file', $data['key']); ?></h3>
                            </td>
                            <td class="value">
                                <?php _e('Field in CMS', $data['key']); ?>
                            </td>
                            <td class="info">
                                <?php _e('If you do not see there your fields from file - please check options above and save',
                                    $data['key']); ?>
                            </td>
                        </tr>
                        <?php foreach ($data['fields'] as $key => $value): ?>
                            <tr>
                                <td class="name">
                                    <label for="mapping<?php echo $key; ?>"><?php echo $value; ?></label>
                                </td>
                                <td class="value">
                                    <select name="options[mapping][<?php echo $key; ?>]"
                                            id="mapping<?php echo $key; ?>">
                                        <option value=""
                                                selected><?php _e('-- not import --', $data['key']); ?></option>
                                        <?php foreach ($data['user_fields'] as $name): ?>
                                            <option value="<?php echo $name; ?>" <?php echo ($data['options']['mapping'][$key] == $name) ? 'selected' : '' ?>>
                                                <?php echo $name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>
                                <h3><?php _e('Default values', $data['key']); ?></h3>
                            </td>
                            <td></td>
                            <td class="info">
                                <?php _e('Set default values for user fields', $data['key']); ?>
                            </td>
                        </tr>
                        <?php foreach ($data['defaults']['text'] as $key => $value): ?>
                            <tr>
                                <td class="name">
                                    <label for="dvt<?php echo $key; ?>"><?php echo $key; ?></label>
                                </td>
                                <td class="value">
                                    <input id="dvt<?php echo $key; ?>" type="text"
                                           value="<?php echo $value; ?>"
                                           name="options[defaults][text][<?php echo $key; ?>]">
                                </td>
                                <td>
                                    <input type="button" class="button remove_default"
                                           value="<?php _e('Delete', $data['key']); ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($data['defaults']['file'] as $key => $value): ?>
                            <tr>
                                <td class="name">
                                    <label for="dvf<?php echo $key; ?>"><?php echo $key; ?></label>
                                </td>
                                <td class="value">
                                    <select name="options[defaults][file][<?php echo $key; ?>]"
                                            id="dvf<?php echo $key; ?>">
                                        <?php foreach ($data['fields'] as $n => $v): ?>
                                            <option value="<?php echo $n; ?>" <?php echo $n == $value ? 'selected' : ''; ?>><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </td>
                                <td>
                                    <input type="button" class="button remove_default"
                                           value="<?php _e('Delete', $data['key']); ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($data['defaults']['custom'] as $key => $value): ?>
                            <tr>
                                <td class="name">
                                    <label for="dvc<?php echo $key; ?>"><?php echo $key; ?></label>
                                </td>
                                <td class="value">
                                    <input type="text" name="options[defaults][custom][<?php echo $key; ?>]"
                                           value="<?php echo $value; ?>" id="dvc<?php echo $key; ?>">
                                </td>
                                <td>
                                    <input type="button" class="button remove_default"
                                           value="<?php _e('Delete', $data['key']); ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="button" class="button button-large add_default_file"
                                       value="<?php _e('Add default value from import\'s field',
                                           $data['key']); ?>">
                                <input type="button" class="button button-large add_default_text"
                                       value="<?php _e('Add default value as text', $data['key']); ?>">
                                <input type="button" class="button button-large add_default_custom"
                                       value="<?php _e('Add custom default', $data['key']); ?>">
                            </td>
                            <td>
                                <input type="submit" class="button button-primary button-large"
                                       value="<?php _e('Save options', $data['key']); ?>">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                break;

            case 'import':
                ?>
                <form method="post">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                    <?php
                    $this->table->prepare_items();
                    $this->table->display();
                    ?>
                </form>
                <?php
                break;

            case 'clear':
                ?>
                <form method="post">
                    <input type="hidden" name="clear" value="1">
                    <?php if ($data['file_exists']): ?>
                        <p><?php _e('Delete the import file and all logs?', $data['key']); ?></p>
                        <input type="submit" class="button button-primary"
                               value="<?php _e('Delete', $data['key']); ?>">
                    <?php else: ?>
                        <p><?php _e('Nothing to delete', $data['key']); ?></p>
                    <?php endif; ?>
                </form>
                <?php
                break;

            default:
                ?>
                <h1><?php _e('Few steps to import your users into Wordpress CMS:', $data['key']); ?></h1>

                <h3><?php _e('1) Upload .csv file with your users data.', $data['key']); ?></h3>
                <p><?php _e('It\'s can be export from another CMS or export from MySQL database etc.',
                        $data['key']); ?></p>

                <h3><?php _e('2) Configure your import to detect all fields and set mapping.', $data['key']); ?></h3>
                <p><?php _e('Note: the password field should be non encrypted.', $data['key']); ?></p>
                <p><?php _e('Note: be careful with mapping. If you not sure what field have responsible into CMS -
                    do not import it.', $data['key']); ?>
                </p>
                <h3><?php _e('3) See the sample table and check twice all data. Start importing.',
                        $data['key']); ?></h3>
                <p><?php _e('Note: use bulk actions and see status column in the each line after import.',
                        $data['key']); ?></p>

                <h3><?php _e('4) Delete the import file', $data['key']); ?></h3>
                <p><?php _e('Note: import file will be deleted and history of statuses will be lost.',
                        $data['key']); ?></p>

                <h2><?php _e('Be careful!', $data['key']); ?></h2>
                <p><?php _e('Strongly recommend you to create a backup of your database using our tool
                    <a href="https://wordpress.org/plugins/database-backups/" target="_blank">Database
                        Backups</a>', $data['key']); ?></p>
                <?php
                break;
        }
        ?>
    </div>
</div>
<script>
    (function ($) {
        var add_default_file = $('.add_default_file'),
            add_default_text = $('.add_default_text'),
            add_default_custom = $('.add_default_custom'),
            remove_default = '.remove_default',
            select_default_text = '.select_default_text',
            select_default_file = '.select_default_file',
            select_default_custom = '.select_default_custom',
            check_all = $('.check_all'),
            table = $('.wp-list-table'),
            import_fields = [
                <?php foreach ($data['fields'] as $field) {
                echo "'" . $field . "',";
            }
                ?>
            ],
            user_fields = [
                <?php foreach ($data['user_fields'] as $field) {
                echo "'" . $field . "',";
            }
                ?>
            ];

        $(document).on('click', remove_default, function () {
            $(this).parent().parent().html('');
        });

        $(document).on('change', select_default_text, function () {
            var key = $(this).find(':selected').val(),
                input = $(this).parent().parent().find('td.value input[type=text]');

            input.attr('name', 'options[defaults][text][' + key + ']');
        });

        $(document).on('change', select_default_file, function () {
            var key = $(this).find(':selected').val(),
                input = $(this).parent().parent().find('td.value select');

            input.attr('name', 'options[defaults][file][' + key + ']');
        });

        $(document).on('change', select_default_custom, function () {
            var key = $(this).val(),
                input = $(this).parent().parent().find('td.value input[type=text]');

            input.attr('name', 'options[defaults][custom][' + key + ']');
        });

        add_default_file.click(function () {
            var html = '',
                i = 0;

            html += '<tr><td class=name>';
            html += '<select class=select_default_file><option> --- </option>';

            $(user_fields).each(function () {
                html += '<option value="' + this + '">' + this + '</option>';
            });

            html += '</select>';
            html += '</td><td class=value>';
            html += '<select>';

            $(import_fields).each(function () {
                html += '<option value="' + i + '">' + this + '</option>';
                i++;
            });

            html += '</select>';
            html += '</td><td>';
            html += '<input type="button" class="button remove_default" value="<?php _e('Delete',
                $data['key']); ?>">';
            html += '</td></tr>';

            $(this).parent().parent().before(html);
        });

        add_default_text.click(function () {
            var html = '';

            html += '<tr><td class=name>';
            html += '<select class=select_default_text><option> --- </option>';

            $(user_fields).each(function () {
                html += '<option value="' + this + '">' + this + '</option>';
            });

            html += '</select>';
            html += '</td><td class=value><input type=text></td><td>';
            html += '<input type="button" class="button remove_default" value="<?php _e('Delete',
                $data['key']); ?>">';
            html += '</td></tr>';

            $(this).parent().parent().before(html);
        });

        add_default_custom.click(function () {
            var html = '';

            html += '<tr><td class=name>';
            html += '<input type=text class=select_default_custom>';
            html += '</td><td class=value><input type=text></td><td>';
            html += '<input type="button" class="button remove_default" value="<?php _e('Delete',
                $data['key']); ?>">';
            html += '</td></tr>';

            $(this).parent().parent().before(html);
        });

        check_all.click(function () {
            if ($(this).attr('checked'))
                table.find('input[type=checkbox]').attr('checked', 'checked');
            else
                table.find('input[type=checkbox]').attr('checked', false);
        });
    })(jQuery);
</script>