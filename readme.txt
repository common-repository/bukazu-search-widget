=== BUKAZU Search widget ===
Contributors: bobvanoorschot
Donate link: http://bukazu.com/
Tags: availability, booking, calendar, rental, Reservation, reviews
Requires at least: 4.6
Tested up to: 6.6.1
Stable tag: 6.2.2
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create a simple search widget for bukazu search calendar

== Description ==

This is used with the bukazu bookings system, you need to have an account with [BUKAZU](https://bukazu.com/ "Your favorite booking software")


== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Create your widget at the 'Widgets' screen in WordPress
4. Choose your options here

Usage with short codes

Add a shortcode [bukazu_search shortcode="" objectcode="" language="en"] to your page.
In "shortcode" you should put your portal-code provided by BUKAZU.
In "objectcode" you should put your object-code if you want to see the calendar of a house.
In "language" you can set the language.
In "page" you should put `reviews` if you want to see the revies of a house, a objectcode is then required


== Frequently Asked Questions ==

= Can I set the language myself? =

Yes, with the language variable.



== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 3.3.2 =
* Fix loading short_code on wrong place

= 3.3.1 =
* Fix bug with empty page variable

= 3.3 =
* Add reviews page option to shortcode

= 3.1 =
* Fixing return calendar on top of page

= 2.6 =
* Update translations

= 2.5 =
* Added language files

= 2.3 =
* Fix outline of submit button
* Add more persons to picker

= 2.2 =
* Can set house calendar with shortcode
* Able to change language of the portal

= 2.0 =
* Load new calendar seach page
* Compatible with new version of bukazu api 

= 1.1 =
* Changed the datepicker to fix problems with old one
* Two date field merged into one datepicker field

= 1.0 =
* First stable verion of plugin

== Upgrade Notice ==

= 1.1 =
The date fields are merged into 1 datepicker field


