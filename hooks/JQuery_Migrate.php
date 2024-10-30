<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Hooks;

use \Mailroad_Switch\Includes\Hooks;

if ( ! class_exists( 'JQuery_Migrate' ) ) {

    final class JQuery_Migrate{

        private string $email;

        public function __construct( $_email ){

            $this->email = $_email;

            add_action(
                'enable_jquery_migrate_helper_notification',
                [
                    $this,
                    'remove_wp_mail_filter'
                ],
                Hooks::PRIORITY
            );

            add_action(
                'wp_ajax_jquery-migrate-downgrade-version',
                [
                    $this,
                    'remove_wp_mail_filter'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'jqmh_email_message',
                [
                    $this,
                    'add_wp_mail_filter'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @action enable_jquery_migrate_helper_notification https://wordpress.org/plugins/enable-jquery-migrate-helper/
         * @action wp_ajax_jquery-migrate-downgrade-version https://wordpress.org/plugins/enable-jquery-migrate-helper/
         * @param mixed $_message
         * @return mixed
         */
        public function add_wp_mail_filter( $_message ){

            add_filter(
                'wp_mail',
                [
                    $this,
                    'change_jquery_migrate_email_recipient'
                ],
                Hooks::PRIORITY
            );

            return $_message;

        }

        /**
         * @action enable_jquery_migrate_helper_notification https://wordpress.org/plugins/enable-jquery-migrate-helper/
         * @action wp_ajax_jquery-migrate-downgrade-version https://wordpress.org/plugins/enable-jquery-migrate-helper/
         * @return void
         */
        public function remove_wp_mail_filter(){

            remove_filter(
                'wp_mail',
                [
                    $this,
                    'change_jquery_migrate_email_recipient'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @filter bloginfo https://developer.wordpress.org/reference/hooks/bloginfo/
         * @param array $_args
         * @return array
         */
        public function change_jquery_migrate_email_recipient( $_args ): array{

            if( array_key_exists( 'to', $_args ) ){

                $_args['to'] = $this->email;

            }

            return $_args;

        }

    }

}