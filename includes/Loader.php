<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Includes;

if ( ! class_exists( 'Loader' ) ) {

    final class Loader{

        public static function load(){

            Settings::register_settings();
            Scripts::register_scripts();
            Hooks::register_hooks();

        }

    }

}