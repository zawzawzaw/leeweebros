=== No Right Click Images Plugin ===
Tags: images, image, right click, stealing
Donate link: http://www.blogseye.com/buy-the-book/
Requires at least: 3.0
Tested up to: 3.5
Contributors: Keith Graham
Stable tag: 2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Disables right click context menu on images to help deter leeches from glomming images.

== Description ==
The No Right Click Images Plugin Plugin uses JavaScript to change the right click action on IMG tags to disable the context menu. It disables the context menu on images only so other right click actions, such as links, should work normally.

Since it uses JavaScript, it targets more images than using plugins that filter pages and rewrite the tag. The plugin will find many images generated in scripts or pasted into posts and comments, that similar plugins will not find.

It is impossible to keep people from stealing images that appear in web pages, but this plugin will deter casual theft from surfers who do not want to interpret HTML or dig into the browser cache.

Smart Phone support is hit or miss. Some web pages rely very much on clickable images and this suppresses some actions, so if an image is large enough to fill a screen, the page may not be able to scroll. It depends very much on your WordPress theme and how it displays images.

Images uploaded via the Wordpress Media uploader will open in a window if clicked. The image will not be protected, so be sure to indicate that there should be no action if the image is clicked at the time you upload the image.

Some browsers prevent javascript from altering the context menu behaviour. The plugin tries to get around this by using a replacement image that briefly replaces the clicked image.
 
== Installation ==
1. Download the plugin.
2. Upload the plugin to your wp-content/plugins directory.
3. Activate the plugin.

== Changelog ==

= 1.0 =
* initial release 

= 1.1 =
* deleted some unused code in the javascript 

= 1.2 =
* Added code that works when javascript creates or loads a new image. Disabled drag and drop on images so images can't be dragged to desktop.

= 1.3 =
* Disabled links to local images (png, gif, jpg) in wp-content, preventing them from opening in a new window. This would allow these images to be saved or copied.

= 1.4 =
* Backed out click check on images because it broke galleries. I left it in as an option if you want to change the code.

= 2.0 =
* Separated javascript into a loadable file. Added an option to replace images on right click in order to thwart FireFox users who choose to block javascript from controlling the context menu. Made drag and drop blocking optional.

= 2.1 =
* Added option so that logged in users are allowed to copy images. Disables the plugin for logged in users. Captured copy to clipboard events to prevent another way of copying in some browsers. Fixed a problem in image replacement that prevented an image from being restored when another image was right clicked before the image times out.

= 2.2 =
* Changed the default so that logged in users cannot copy images. Too many people tested the plugin without checking the settings and assumed that the plugin was broken. They did not read the documentation, try the settings, or check the WordPress forums. I am sorry that I had to do this, but users were indicating on the WordPress plugin page that it didn't work.

= 2.3 =
* Added support for longclick and touch interface for android and ipad/iphone.

= 2.4 =
* Added alternate replacement image url for webmasters who don't like the o-slash
* Added an option to turn off IOS Android events that screwed up some web sites.
* Added an extra Security check on plugin load.

= 2.5 =
* added Cell phone styles to javascript for Cell phones. I hope that his helps with Cell phone images. Tested on an old iPad - it may work. Works mostly in iPad, android phone works on some images.
* This readme file did not update on the WordPress site so I have reloaded it.

== Frequently Asked Questions ==
= I click on an image to open it and then I can save it =
When you added the image to WordPress you specified this behavior. When you insert an image you have to specify that you don't want to have a click on the image open the image. It is up to you to protect your images by not opening the image on a click.
If you are able to click on an image to display the image in a new window, it is then outside of Wordpress and can't be protected.
= I have a Slideshow or Gallery and users can right click on the images in the gallery. =
Special image presentation plugins that use jQuery or other Javascript systems override the behavior of this plugin. When they load they take over and my plugin can't help you. You need to contact the authors of the gallery and ask they they disable the right click event and drag events inside their plugin.


== Support ==
= Rate the Plugin =
This plugin is free and I expect nothing in return. Please rate the plugin at: http://wordpress.org/extend/plugins/no-right-click-images-plugin/
= Buy my book =
If you wish to support my programming, buy my book:
http://www.blogseye.com/buy-the-book/ : Error Message Eyes: A Programmer's Guide to the Digital Soul
= Some of my many plugins =
http://wordpress.org/extend/plugins/permalink-finder/ : Permalink Finder Plugin

http://wordpress.org/extend/plugins/open-in-new-window-plugin/ : Open in New Window Plugin

http://wordpress.org/extend/plugins/kindle-this/ : Kindle This - publish blog to user's Kindle

http://wordpress.org/extend/plugins/stop-spammer-registrations-plugin/ : Stop Spammer Registrations Plugin

http://wordpress.org/extend/plugins/collapse-page-and-category-plugin/ : Collapse Page and Category Plugin

http://wordpress.org/extend/plugins/custom-post-type-list-widget/ : Custom Post Type List Widget

