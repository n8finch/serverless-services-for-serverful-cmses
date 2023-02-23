<?php
/**
 * Plugin Name: Static GeoIP Serverless Service
 * Plugin URI: https://github.com/n8finch
 * Description: A serverless GeoIP implementation.
 * Author: Nate Finch
 * Author URI: https://n8finch.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once __DIR__ . '/static-geoip-customizations.php';
