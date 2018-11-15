<?php
/*
Plugin Name: Migrate Users
Description: Plugins provides support to migrate users from CSV to Wordpress
Version: 1.0.1
Author: AGriboed
Author URI: https://v1rus.ru/
*/
if (!defined('ABSPATH') && !is_admin()) {
    exit;
}

if (!class_exists('WP_List_Table')) {
    include ABSPATH . '/wp-admin/includes/class-wp-list-table.php';
}
include __DIR__ . '/src/MigrateUsers.php';
include __DIR__ . '/src/Table.php';
include __DIR__ . '/src/Logger.php';

new \MigrateUsers\MigrateUsers(__FILE__);