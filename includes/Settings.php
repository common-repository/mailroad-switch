<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Includes;

if ( ! class_exists( 'Settings' ) ) {

    final class Settings{

        public const OPTION_NAME = 'mailroad-switch-admin-emails';

        public static function register_settings(){

            add_action(
                'admin_init',
                [
                    __CLASS__,
                    'register_wordpress_options'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'plugin_action_links_' . MAILROAD_SWITCH_PLUGIN_BASENAME,
                [
                    __CLASS__,
                    'add_plugin_action_links'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @action admin_init https://developer.wordpress.org/reference/hooks/admin_init/
         * @return void
         */
        public static function register_wordpress_options(){

            register_setting(
                'general',
                self::OPTION_NAME,
                [
                    'type' => 'string',
                    'default' => ''
                ]
            );

            add_settings_field(
                self::OPTION_NAME,
                '<span>Separate Admin Email Recipients <small>(from <em>Mailroad Switch</em>)</small></span>',
                function (){
                    \Mailroad_Switch\Templates\Form::render();
                },
                'general',
                'default',
                [
                    'class' => self::OPTION_NAME . '-wrapper',
                ]
            );

        }

        /**
         * @filter plugin_action_links_{$plugin_file} https://developer.wordpress.org/reference/hooks/plugin_action_links_plugin_file/
         * @param array $_actionLinks
         * @return array
         */
        public static function add_plugin_action_links( array $_actionLinks ): array{

            array_unshift( $_actionLinks, '<a href="' . admin_url( 'options-general.php#new_admin_email' ) . '">Settings</a>' );

            return $_actionLinks;

        }

        /**
         * @param string $_type
         * @return string
         */
        public static function get_email_recipient( string $_type ): string{

            $emails = get_option( self::OPTION_NAME );

            if( is_array( $emails ) && array_key_exists( $_type, $emails ) ){
                return $emails[$_type];
            }

            return get_option('admin_email');

        }

    }

}