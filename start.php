<?php
/**
 * Remove user settings from Topbar Menu
 * 
 */

elgg_register_event_handler('pagesetup', 'system', 'usersettings_remove', 1000);
elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'elgg_extend_user_hover_menu');

function usersettings_remove() {
	// remove settings from topbar menu
	// see alos /elgg/engine/lib/user.php users_pagesetup()
	elgg_unregister_menu_item('topbar', 'usersettings'); 
}

function elgg_extend_user_hover_menu($hook, $type, $return, $params) {
	// enable user settings in profile
	// see also /elgg/engine/lib/users.php elgg_user_hover_menu()
	if (get_context()=='profile') {
		$user = $params['entity'];
		if (elgg_is_logged_in()) {
			if (elgg_get_logged_in_user_guid() == $user->guid) {
				$url = "settings/user/$user->username/edit";
				$item = new ElggMenuItem('settings', elgg_echo('settings'), $url);
				$item->setSection('action');
				$return[] = $item;
			}
		}
		return $return;
	}
}

