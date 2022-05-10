=== Plugin Name ===
Contributors: nathanrice, studiopress, wpmuguru
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5553118
Tags: genesis, genesiswp, studiopress
Requires at least: 3.9
Tested up to: 6.0
Stable tag: 1.0.1

This plugin lets you one-click update to the latest Genesis release, even if it's still in beta.

== Description ==

This plugin hooks into the data sent to the Genesis API servers and lets us know that you'd like to update to the latest version of Genesis, even if it's still in beta.

== Installation ==

1. Upload the entire `genesis-beta-tester` folder to the `/wp-content/plugins/` directory
1. DO NOT change the name of the `genesis-beta-tester` folder
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Can I use the beta tester plugin to update to the nightly builds? =

Not just yet, but that feature is coming.

= I'm not seeing the update notification. What's up? =

If you activate the plugin and do not see the update notification, that likely means that there is no beta release currently available. However, if you know there is a beta update available, and still do not see the notification, try visiting the "Dashboard -> Updates" screen and look for the update there.

== Changelog ==

= 1.0.1 =
* Test with latest WordPress version

= 1.0.0 =
* Conform to WordPress Development Standards for PHP

= 0.9.5 =
* Use WP filter for better stability.

= 0.9.4 =
* Version bump.

= 0.9.3 =
* Add textdomain loader
* Move /languages to root
* Add plugin header i18n

= 0.9.2 =
* Make POT file.

= 0.9.1 =
* Compatibility with 3.9+

= 0.9.0 =
* Initial Release
