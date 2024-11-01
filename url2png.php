<?php

/*
Plugin Name: Url2Png Screenshots
Version: 1.0.1
Author URI: http://www.bondero.com
Plugin URI: http://www.bondero.com
Description: Integrate screenshots from url2png.com. If screenshots are not existant on your server it grabs a picture through url2png's service and saves it to disk for later access.
Author: Nader Cserny
License: GPL2
    
*/

// URL2PNG API URL
define('API_URL', 'http://api.url2png.com/v3');
// Enter your API key
define('API_KEY', 'YOUR_API_KEY');
// Enter your secret key
define('SECRET_KEY', 'YOUR_SECRET_KEY');

// Gets the wp-content directory
define('CONTENT_DIR', dirname(dirname(dirname(__FILE__))));
// Change 'screnshots' to an alternative directory if you like
define('SCREENSHOT_DIR', CONTENT_DIR . '/' . 'screenshots');
// Used for the frontend, if you have another directory than 'screenshots' change it here as well
define('SCREENSHOT_URL', '/wp-content/screenshots');


class Url2png {
	protected $api_url;
	protected $api_key;
	protected $secret_key;
	protected $token;
	
	public function __construct() {
		$this->api_url = API_URL;
		$this->api_key = API_KEY;
		$this->secret_key = SECRET_KEY;
		$this->screenshot_dir = SCREENSHOT_DIR;
		$this->screenshot_url = SCREENSHOT_URL;
	}
	
	// Construct the URL
	public function getUrl($url, $width, $height) {
		$url = urlencode(trim($url));
		$token = md5($this->secret_key . '+' . $url);
		$size = $width . 'x' . $height;
		
		$img = $this->api_url . '/' . $this->api_key . '/' . $token . '/' . $size . '/' . $url;
		
		return $img;
	}
	
	// Save the screenshot to disk
	public function saveScreenshot($url, $width, $height) {
		$path = $this->screenshot_dir . '/' . md5($url . '+' . $width . '+' . $height) . '.png'; 
		
		$img = $this->getUrl($url, $width, $height);
		
		$ch = curl_init($img);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$rawdata = curl_exec($ch);
		curl_close ($ch);
		if (file_exists($path)) {
			unlink($path);
		}
		$fp = fopen($path,'w+');
		fwrite($fp, $rawdata);
		fclose($fp);

		if (file_exists($path)){	
			return $path;
		}

	}
	
	// Get the screenshot and either return the path or display the image with the img tag
	public function getScreenshot($url, $width, $height, $imagetag = false, $class = false) {
		$path = $this->screenshot_dir . '/' . md5($url . '+' . $width . '+' . $height) . '.png';
		$image_url = get_bloginfo('url') . $this->screenshot_url . '/' . md5($url . '+' . $width . '+' . $height) . '.png';
		
		if (!file_exists($path)) {
			$this->saveScreenshot($url, $width, $height);
		}

		if ($imagetag == true) {
			echo '<img src="' . $image_url . '" alt="' . $url . '" class="' . $class . '" width="' . $width . '" />';
		} else {
			return $image_url;
		}
		
	}
	


}

$url2png = new Url2png();
