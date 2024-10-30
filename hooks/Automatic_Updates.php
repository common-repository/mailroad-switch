<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Hooks;

use \Mailroad_Switch\Includes\Hooks;

if ( ! class_exists( 'Automatic_Updates' ) ) {

    final class Automatic_Updates{

        private string $email;

        public function __construct( $_email ){

            $this->email = $_email;

            add_filter(
                'automatic_updates_debug_email',
                [
                    $this,
                    'change_automatic_updates_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'auto_plugin_theme_update_email',
                [
                    $this,
                    'change_automatic_updates_email_recipient'
                ],
                Hooks::PRIORITY
            );

            add_filter(
                'auto_core_update_email',
                [
                    $this,
                    'change_automatic_updates_email_recipient'
                ],
                Hooks::PRIORITY
            );

        }

        /**
         * @filter automatic_updates_debug_email https://developer.wordpress.org/reference/hooks/automatic_updates_debug_email/
         * @filter auto_plugin_theme_update_email https://developer.wordpress.org/reference/hooks/auto_plugin_theme_update_email/
         * @filter auto_core_update_email https://developer.wordpress.org/reference/hooks/auto_core_update_email/
         * @param array $_email
         * @return array
         */
        public function change_automatic_updates_email_recipient( array $_email ): array{

            if( is_array( $_email ) && array_key_exists( 'to', $_email ) ){

                $_email['to'] = $this->email;

            }

            return $_email;

        }

    }

}