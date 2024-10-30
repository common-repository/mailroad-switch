<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
* @package marsworks/mailroad-switch
* Plugin Name: Mailroad Switch
* Description: Automated admin email rerouting. This plugin allows you to set separate admin email recipients for certain actions such as New User Registration or Fatal Errors.
* Version: 1.0
* Author: MARSWorks Inc.
* Author URI: https://marsworks.com
*/

namespace Mailroad_Switch;

defined( 'ABSPATH' ) or die();

if( ! defined( 'MAILROAD_SWITCH_PLUGIN_BASENAME' ) ){

    define( 'MAILROAD_SWITCH_PLUGIN_BASENAME', plugin_basename(__FILE__) );

}

if( file_exists( __DIR__ . '/vendor/autoload.php' ) ){

    require_once( __DIR__ . '/vendor/autoload.php' );

}

Includes\Loader::load();