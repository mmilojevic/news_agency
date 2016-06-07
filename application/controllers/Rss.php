<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('post');
        $feeds = $this->post->getLatestPosts(10);
        header("Content-Type: application/xml; charset=ISO-8859-1"); 
        
        $rss_feed = '<?xml version="1.0" encoding="ISO-8859-1" ?> 
	                <rss version="2.0"> 
	                    <channel> 
	                        <title>News</title> 
                                <link>'.WWW_PATH.'</link> 
	                        <description>News Agency</description> 
	                        <language>English</language> 
	                        <image> 
	                            <title>News</title> 
	                            <url>'.IMG_PATH.'logo_light_new.png</url> 
	                            <link>'.WWW_PATH.'</link> 
	                        </image>'; 
        foreach ($feeds as $feed) {
            $rss_feed .= '<item> 
                            <title>'. $feed["title"] .'</title> 
                            <link>'.WWW_PATH.'home/single/'. $feed["id"] .'</link> 
                        </item>'; 
        }
        
        $rss_feed .= '</channel> 
	                </rss>'; 
        
        echo $rss_feed;
    }
    
    
}