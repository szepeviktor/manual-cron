<?php
/*
Plugin name: Manual cron
Version: 1.0.1
Description: Triggers WP-cron from a Dashboard widget and displays cron output.
Plugin URI: https://github.com/szepeviktor/manual-cron
License: The MIT License (MIT)
Author: Viktor Szépe
GitHub Plugin URI: https://github.com/szepeviktor/manual-cron
Filters: manual-cron-timeout
*/

add_action( 'wp_dashboard_setup', 'o1_manual_cron_add_widget' );

function o1_manual_cron_add_widget() {

    $doing_wp_cron = sprintf( '%.22F', microtime( true ) );
    $url = add_query_arg( 'doing_wp_cron', $doing_wp_cron, site_url( 'wp-cron.php' ) );
    $timeout = apply_filters( 'manual-cron-timeout', 20000 );
    $script_vars = array(
        'url' => $url,
        'timeout' => $timeout,
    );

    wp_enqueue_script( 'manual-cron', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'manual-cron', 'MANCRON', $script_vars );
    wp_add_dashboard_widget(
        'manual_cron_widget',
        'Manual WP-cron',
        'o1_manual_cron_output'
    );
}

function o1_manual_cron_output() {

    print '<button id="manual-cron" class="button button-primary">Run now</button>';
    print '<div id="manual-cron-output" style="margin-top: 8px;"></div>';
}
