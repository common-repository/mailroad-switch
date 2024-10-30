<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Hooks;

use \Mailroad_Switch\Includes\Hooks;

if ( ! class_exists( 'Users' ) ) {

    final class Users{

        private string $email;

        public function __construct( $_email ){

            $this->email = $_email;

            add_filter(
                'wp_new_user_notification_email',
                [
                    $this,
                    'change_user_notification_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'wp_new_user_notification_email_admin',
                [
                    $this,
                    'change_user_notification_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'password_change_email',
                [
                    $this,
                    'change_user_notification_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'email_change_email',
                [
                    $this,
                    'change_user_notification_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'user_request_confirmed_email_to',
                [
                    $this,
                    'change_user_confirmed_notification_email_recipient'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @filter wp_new_user_notification_email https://developer.wordpress.org/reference/hooks/wp_new_user_notification_email/
         * @filter password_change_email https://developer.wordpress.org/reference/hooks/password_change_email/
         * @filter email_change_email https://developer.wordpress.org/reference/hooks/email_change_email/
         * @param array $_email
         * @return array
         */
        public function change_user_notification_email_recipient( array $_email ): array{

            if( is_array( $_email ) && array_key_exists( 'to', $_email ) ){

                if( $_email['to'] === get_option( 'admin_email' ) ){

                    $_email['to'] = $this->email;

                }

            }

            return $_email;

        }

        /**
         * @filter user_request_confirmed_email_to https://developer.wordpress.org/reference/hooks/user_request_confirmed_email_to/
         * @return string
         */
        public function change_user_confirmed_notification_email_recipient(): string{

            return $this->email;

        }

    }

}