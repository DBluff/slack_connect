<?php
#
# Slack_Connect setup page
#

// Do the include and authorization checking ritual -- don't change this section.
include '../../../include/db.php';
include_once '../../../include/general.php';
include '../../../include/authenticate.php'; if (!checkperm('a')) {exit ($lang['error-permissiondenied']);}

$plugin_name = 'slack_connect';
if(!in_array($plugin_name, $plugins))
{plugin_activate_for_setup($plugin_name);}

// Specify the name of this plugin and the heading to display for the page.
$plugin_name = 'slack_connect';
$plugin_page_heading = $lang['slack_connect_configuration'];

// Build the $page_def array of descriptions of each configuration variable the plugin uses.

$page_def[] = config_add_text_input('slack_connect_webhook', $lang['slack_connect_webhook']);
$page_def[] = config_add_text_input('slack_connect_username', $lang['slack_connect_username']);
$page_def[] = config_add_text_input('slack_connect_room', $lang['slack_connect_room']);
$page_def[] = config_add_text_input('slack_connect_icon', $lang['slack_connect_icon']);
$page_def[] = config_add_single_select('slack_connect_color', $lang['slack_connect_color'], array('normal', 'good', 'warning', 'danger'), false);
$page_def[] = config_add_text_input('slack_connect_title', $lang['slack_connect_title']);
$page_def[] = config_add_text_input('slack_connect_link', $lang['slack_connect_link']);
$page_def[] = config_add_text_input('slack_connect_fallback', $lang['slack_connect_fallback']);

// Do the page generation ritual -- don't change this section.
$upload_status = config_gen_setup_post($page_def, $plugin_name);
include '../../../include/header.php';
config_gen_setup_html($page_def, $plugin_name, $upload_status, $plugin_page_heading);
include '../../../include/footer.php';
