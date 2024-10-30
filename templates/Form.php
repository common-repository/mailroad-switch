<?php /** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */
/*
 * @package marsworks/mailroad-switch
 */

namespace Mailroad_Switch\Templates;

use \Mailroad_Switch\Includes\Settings;
use \Mailroad_Switch\Includes\Hooks;

if ( ! class_exists( 'Form' ) ) {

    final class Form{

        public static function render(){

            ?>
                <p class="mailroad-switch-admin-emails-section-description">Below you may input different email addresses for WordPress email notifications that would otherwise go to the admin email (above). You may input multiple emails in the fields below by separating them with a comma (,).</p>
            <?php

            $emails = get_option( Settings::OPTION_NAME );

            $adminEmail = get_option('admin_email');

            foreach ( Hooks::get_available_hook_types() as $_type => $_content ){

                if( is_array( $emails ) && array_key_exists( $_type, $emails ) ){
                    $email = $emails[$_type];
                }else{
                    $email = $adminEmail;
                }

                ?>

                <div class="<?php echo esc_html( Settings::OPTION_NAME ); ?>-inner-wrapper">

                    <label for="<?php echo esc_html( Settings::OPTION_NAME ); ?>[<?php echo esc_html( $_type ); ?>]">

                        <span><?php echo esc_html( $_content['label'] ); ?></span>

                        <input type="text" value="<?php echo esc_html( $email ); ?>" name="<?php echo esc_html( Settings::OPTION_NAME ); ?>[<?php echo esc_html( $_type ); ?>]" id="<?php echo esc_html( Settings::OPTION_NAME ); ?>[<?php echo esc_html( $_type ); ?>]">

                    </label>

                    <small><?php echo esc_html( $_content['description'] ); ?></small>

                </div>

                <?php

            }

        }

    }

}