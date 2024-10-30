<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Includes;

if ( ! class_exists( 'Scripts' ) ) {

    final class Scripts{

        public static function register_scripts(){

            add_action(
                'admin_enqueue_scripts',
                [
                    __CLASS__,
                    'load_scripts'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @action admin_enqueue_scripts https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
         * @return void
         */
        public static function load_scripts(){

            wp_register_script( 'mailroad-switch-admin-scripts', plugin_dir_url( __FILE__ ) . '../assets/js/admin.js', ['jquery'], '', true );

            wp_localize_script( 'mailroad-switch-admin-scripts', 'MAILROAD_SWITCH_LOCAL', [
                'wrapper_class'     => Settings::OPTION_NAME . '-wrapper'
            ]);

            wp_enqueue_script( 'mailroad-switch-admin-scripts' );

            wp_register_style( 'mailroad-switch-admin-styles', plugin_dir_url( __FILE__ ) . '../assets/styles/admin.css', [], '', 'all' );

            wp_enqueue_style( 'mailroad-switch-admin-styles' );

        }

    }

}