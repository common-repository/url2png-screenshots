=== URL2PNG Screenshots ===
Contributors: naderc
Tags: screenshots, url2png, images
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 1.0.1

Integrate screenshots from url2png.com into your website.

== Description ==

For now the plugin is very basic but functional. Use this function within your theme files, inside loops or any other place in your code. Check out the FAQ. You can also use other functions of the plugin, just have a look at the code.

Skeleton: `$url2png->getScreenshot('Website URL', WIDTH, HEIGHT, IMAGETAG, CLASS)`

Example: `$url2png->getScreenshot('www.bondero.com', 300, 300)`
// Result: `http://www.example.com/wp-content/screenshots/...`

Example: `$url2png->getScreenshot('www.bondero.com', 300, 300, true)`
// Result: `<img src="http://example.com/wp-content/screenshots/.…" alt="Website URL" class="" width="300" />`

Example: `$url2png->getScreenshot('www.bondero.com', 300, 300, true, 'alignleft')`
// Result: `<img src="http://example.com/wp-content/screenshots/.…" alt="Website URL" class="alignleft" width="300" />`


== Installation ==

The installation is simple: 

1. Upload `url2png.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit the head of the plugin: API Key, Secret Key, Alternative screenshot directory
4. Place `<?php $url2png->getScreenshot('Website URL', WIDTH, HEIGHT, true); ?>` or other functions in your templates

Make sure the screenshots directory is writeable by your webserver

== Changelog ==

= 1.0.1 =
* Readme Change + Plugin Tuning

= 1.0 =
* Initial plugin: Get screenshot, save it to disk, display it

== Frequently Asked Questions ==

= What features are planned in future versions? =

* Make API-Key, Secret Key editable through the admin interface
* Make screenshots featured images by default / on demand
* Enable the use of shortcode within posts
* Any other ideas?

= More information =
Visit [BONDERO](http://www.bondero.com)
