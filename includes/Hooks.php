<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Includes;

if ( ! class_exists( 'Hooks' ) ) {

    final class Hooks{

        public const PRIORITY = PHP_INT_MAX - 1;

        public static function register_hooks(){

            $emails = get_option( Settings::OPTION_NAME );

            $adminEmail = get_option('admin_email');

            foreach ( self::get_available_hook_types() as $_type => $_content ){

                if( is_array( $emails ) && array_key_exists( $_type, $emails ) ){
                    $email = $emails[$_type];
                }else{
                    $email = $adminEmail;
                }

                if( is_array( $_content ) && array_key_exists( 'class', $_content ) ){
                    if( class_exists( $_content['class'] ) ){
                        new $_content['class']($email);
                    }
                }

            }

        }

        /**
         * @return string[]
         */
        public static function get_available_hook_types(): array{

            $types = [
                'updates'   => [
                    'label'         => 'Automatic Updates',
                    'description'   => 'Email notifications pertaining to automatic updates.',
                    'class'         => '\Mailroad_Switch\Hooks\Automatic_Updates',
                ],
                'errors'   => [
                    'label'         => 'Errors',
                    'description'   => 'Email notifications pertaining to fatal PHP errors or fatal WP_Errors.',
                    'class'         => '\Mailroad_Switch\Hooks\Errors',
                ],
                'users'   => [
                    'label'         => 'Users',
                    'description'   => 'Email notifications pertaining to user actions, such as: new user, password changed, email changed, user approved, etc.',
                    'class'         => '\Mailroad_Switch\Hooks\Users',
                ],
            ];

            if( self::is_plugin_installed('enable-jquery-migrate-helper/enable-jquery-migrate-helper.php') ){

                $types['jquery_migrate'] = [
                    'label'         => 'JQuery Migrate',
                    'description'   => 'Email notifications from the Enable jQuery Migrate Helper plugin. These include weekly reports of deprecated jQuery methods and automatic jQuery version downgrading.',
                    'class'         => '\Mailroad_Switch\Hooks\JQuery_Migrate',
                ];

            }

            return apply_filters( 'mailroad_switch_available_hooks', $types );

        }

        /**
         * @param string $_pluginDirectoryFile
         * @return bool
         */
        private static function is_plugin_installed( string $_pluginDirectoryFile ): bool{

            if( file_exists( plugin_dir_path(__FILE__) . '../../' . $_pluginDirectoryFile ) ){

                return true;

            }

            return false;

        }

    }

}