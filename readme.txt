=== Mailroad Switch ===
Contributors: marsworks
Tags: admin, email, emails, rerouting, separate, recipients, recipient
Requires at least: 5.2
Tested up to: 5.7.2
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automated admin email rerouting. This plugin allows you to set separate admin email recipients for certain actions such as New User Registration or Fatal Errors.

== Description ==
This plugin allows you to set multiple admin email addresses. This means that you can finally send all of those New User emails to go to HR, and send those WP Error and Automatic Update emails to IT.

== Installation ==
1. Upload `mailroad-switch.zip` through the 'Add Plugins' screen in WordPress.
2. Activate the plugin in WordPress.
3. Navigate to Settings > General to input your new email addresses.

== Frequently Asked Questions ==
= What Plugins are Supported? =
Currently, the only third-party plugin which is supported is 'Enable jQuery Migrate Helper'

We did this because this plugin is used on many sites since the release of WordPress 5.2. Enable jQuery Migrate Helper comes with weekly emails along with emails regarding automatic downgrades of your site's jQuery version.

You will be able to set an email recipient for the emails from Enable jQuery Migrate Helper. This option will only show if you have the Enable jQuery Migrate Helper plugin in your WordPress plugins directory.

= How do I retrieve a value to use in my code? =
You are able to use the static method `get_email_recipient`

`
$address = \Mailroad_Switch\Includes\Settings::get_email_recipient( 'errors' );
`

Default valid values passed to the method are:
+ `updates`
+ `errors`
+ `users`
+ `jquery_migrate`

If the email type does not exist or the option is not set for it, it will fallback to the admin email address you have set for your WordPress site.

= I have a plugin that is sending me emails, but I do not see an option to change the email recipient. What do I do? =
You can open a question in the support forum to the right, and request that we add support for a third-party plugin.

= I don't have time to wait for you to add support for more plugins! I need to do it right now! *For Developers Only* =
You are able to use the filter `mailroad_switch_available_hooks`

`
add_filter( "mailroad_switch_available_hooks", function( $types ){
   if( ! array_key_exists( "my_unique_type", $types ) ){
      $types["my_unique_type"] = [
         "label" => "My Unique Type",
         "description" => "Emails coming from my custom plugin or theme",
         "class" => "\My\Class\Handler"
      ];
   }
   return $types;
} );
`

The above code snippet will add a new admin setting below the other fields. The construct of your `\My\Class\Handler` should have one parameter which will be the email address retrieved from the setting. You can then implement any WordPress or Plugin or Theme action and filter hooks in your class to change email recipients.


== Screenshots ==
1. New admin email options

== Changelog ==
= 1.0 =
+ Initial launch of plugin
+ Includes support for WordPress Core email notifications for User notices, WP Error notices, and Automatic Update notices.
+ Includes support for Enable jQuery Migrate Helper plugin email notices.