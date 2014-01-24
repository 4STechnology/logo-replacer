<?php
/**
 * Plugin Name: Logo Replacer
 * Plugin URI: https://github.com/4STechnology/logo-replacer
 * Description: Replace WordPress' logo to user-uploaded one at login and navigation bar
 * Version: 1.0
 * Author: 4S Technology <4stech@bis5.net>
 * Author URI: http://4stechnology.wordpress.com
 * License: GPLv3
 */
/**
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

class LogoReplacer {
	private function replace_login_logo() {
		if (file_exists(plugin_dir_url(__file__).'/inc/login.png'))
			replace_logo("login");
	}
	private function replace_admin_logo() {
		if (version_compare('3.8.*', get_bloginfo('version'), '<=')) {
			if (file_exists(plugin_dir_url(__FILE__).'/inc/admin.png'))
				replace_logo("admin");
		} else {/* <= 3.7.x only! */}
	}

	public function __construct() {
		add_action('login_head', array($this, 'replace_login_logo'));
		add_action('admin_head', array($this, 'replace_admin_logo'));
	}

	private function replace_logo($type) {
		$url = plugin_dir_url(__FILE__) . 
			$type=='login' ? '/inc/login.png' : '/inc/admin.png';
		echo "<style type=\"text/css\">
			h1 a {
				background-image: url($url);
			}
</style>";
	}
}
new LogoReplacer();
