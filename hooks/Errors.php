<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Hooks;

use \Mailroad_Switch\Includes\Hooks;

if ( ! class_exists( 'Errors' ) ) {

    final class Errors{

        private string $email;

        public function __construct( $_email ){

            $this->email = $_email;

            add_filter(
                'recovery_mode_email',
                [
                    $this,
                    'change_error_email_recipient'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @filter recovery_mode_email https://developer.wordpress.org/reference/hooks/recovery_mode_email/
         * @param array $_email
         * @return array
         */
        public function change_error_email_recipient( array $_email ): array{

            if( is_array( $_email ) && array_key_exists( 'to', $_email ) ){

                $_email['to'] = $this->email;

            }

            return $_email;

        }

    }

}