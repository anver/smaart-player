<?php

namespace SMAARTWEB\SmaartPlayer\Admin;

class SmaartPlayerAdmin {

    /**
     * Default constructor
     * @access public
     */
    public function __construct() {
        add_action( 'init', [$this, 'enable_vc_video_shortcode'] );
    }

    /**
     * This will display an icon for the webinar timer inside visual composer
     * @access public
     */
    public function enable_vc_video_shortcode() {
        if ( defined( 'WPB_VC_VERSION' ) ) {
            vc_map( array(
                "name" => "Webinar Video",
                "description" => "Displays the webinar video player",
                "base" => "webby-video",
                "class" => "",
                "controls" => "full",
                "icon" => plugin_dir_url( dirname( __FILE__ ) ) . 'images/video.jpg',
                "category" => 'PCF Addons',
                "params" => array(
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Video Url',
                        "param_name" => "src",
                        "description" => "Enter video url",
                        "admin_label" => true
                    ),
                    array(
                        "type" => "checkbox",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Autoplay Video',
                        "param_name" => "autoplay",
                        "description" => "Check to autoplay video",
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "heading" => 'Video Width',
                        "param_name" => "width",
                        "description" => "Key in the width of the video, the default is 800px",
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "heading" => 'Video Height',
                        "param_name" => "height",
                        "description" => "Key in the height of the video, the default is 600px",
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Poster Url',
                        "param_name" => "poster",
                        "description" => "Choose a initial poster url that shows up initially before the video plays",
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Control Visibility',
                        "param_name" => "controls",
                        'value' => ['yes' => 'Yes', 'no' => 'No'],
                        "description" => "Select no if you want no controls on the player",
                    ),
                )
            ) );
        }
    }

}
