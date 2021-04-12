<?php
/**
* Class name: TimberService()
*
* This class contains methods provided to timber templates
*
*/

namespace Services;
use Timber;

class TimberService
{
    /**
    * svg() allows to get code from an SVG file  
    *
    * @param bool  $url  SVG file url
    *
    * @return string  SVG code 
    */

     public static function get_section_page($post_id){
        $fields = get_field('s1-content',$post_id);
        return $fields;
    }


    public static function get_posts($cpt = 'post' , $number = 3 ){

        $args = array(
            'post_type'       => array($cpt),
            'post_status'     => array('publish'),
            'posts_per_page'  => $number,
        );
        $posts = new Timber\PostQuery($args);
        
        return $posts;
    }
    
    public static function svg($url){
        $baseUrl = dirname(dirname(ROOT));
        $toReplace = get_site_url() . '/wp-content';
        $finalUrl = str_replace($toReplace, $baseUrl, $url);
        return file_get_contents($finalUrl, false);
    }

    public static function getVimeoVideoIdFromUrl($url) {
        $regs = array();
        $id = '';
        if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
            $id = $regs[3];
        }
        return $id;
    }


    public static function getYoutubeVideoIdFromUrl($url) {
        $regs = array();
        $id = '';
        if (preg_match('%^https?:\/\/(?:www\.|player\.)?youtube.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
            $id = $regs[3];
        }
        return $id;
    }
}

