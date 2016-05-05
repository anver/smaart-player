<?php

namespace SMAARTWEB\SmaartPlayer\Front;

class SmaartPlayerPublic {

    /**
     * Checks if the shortcode exists in the content
     * @access public
     */
    public $shortcode_exists;

    /**
     * The players array
     * @access public
     */
    public $players;

    /**
     * The player id
     * @access public
     */
    public $player_id;

    /**
     * Default constructor
     * @access public
     */
    public function __construct() {
        add_action( 'template_redirect', [$this, 'shortcode_exists'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'wp_footer', [$this, 'initialize_players'] );
        add_shortcode( 'webby-video', [$this, 'render_shortcode'] );
        add_filter( 'smaart-video-shortcode-exists', [$this, 'enque_assets_on_easy_doc_post_type'], 10, 2 );
    }

    /**
     * Enque assets on easy product builder documentation custom post type
     * @access public
     * @param bool $shortcode_exists The boolean value whether shortcode exists
     * or not on the page content
     * @param object $post WordPress post object
     * @return bool Returns true if the post content has easydoc shortcode
     */
    public function enque_assets_on_easy_doc_post_type( $shortcode_exists, $post ) {
        if ( has_shortcode( $post->post_content, 'easy-doc' ) ) {
            return TRUE;
        }
    }

    /**
     * Render the video shortcode
     * @access public
     * @param $args array the attributes passed to the function from the shortcode
     * @param $content string The shortcode content between the brackets
     */
    public function render_shortcode( $atts, $content ) {
        extract( shortcode_atts( [
            'src' => '',
            'autoplay' => 'false',
            'width' => '800',
            'height' => '600',
            'poster' => '',
            'controls' => 'yes'], $atts ) );

        $this->player_id = uniqid( 'webby-video-' );
        $this->players[$this->player_id]['id'] = $this->player_id;
        $this->players[$this->player_id]['src'] = $src;
        $this->players[$this->player_id]['autoplay'] = $autoplay;
        $this->players[$this->player_id]['controls'] = $controls;

        if ( preg_match( "/^(https?:\/\/)?(www.)?(youtube\.com|youtu\.be)\/watch\?v=\w+/is", $src ) ) {
            $video_type = 'youtube';
        }

        if ( preg_match( "/\.m3u8$/is", $src ) ) {
            $video_type = 'hls';
        }

        if ( preg_match( "/\.mp4$/is", $src ) ) {
            $video_type = 'mp4';
        }

        $this->players[$this->player_id]['provider'] = $video_type;
        ob_start();
        require "views/$video_type.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     * Register the scripts for the video player.
     */
    public function enqueue_scripts() {
        if ( $this->shortcode_exists ) {
            $bower_url = plugin_dir_url( dirname( __FILE__ ) ) . 'bower_components/';
            $videojs_url = $bower_url . 'video.js/dist/video.min.js';
            $videojs_hls = $bower_url . 'videojs-contrib-hls/dist/videojs-contrib-hls.min.js';
            $videojs_youtube = $bower_url . 'videojs-youtube/dist/Youtube.min.js';
            wp_enqueue_script( 'videojs', $videojs_url, ['jquery'] );
            wp_enqueue_script( 'videojs-hls', $videojs_hls, ['videojs'] );
            wp_enqueue_script( 'videojs-youtube', $videojs_youtube, ['videojs'] );
        }
    }

    /**
     * Register the stylesheets for the video player.
     */
    public function enqueue_styles() {
        if ( $this->shortcode_exists ) {
            $bower_url = plugin_dir_url( dirname( __FILE__ ) ) . 'bower_components/';
            $videojs_url = $bower_url . 'video.js/dist/video-js.css';
            wp_enqueue_style( 'videojs', $videojs_url );
            wp_enqueue_style( 'smaart-player-styles', plugins_url( 'css/player-styles.css', __FILE__ ), ['videojs'] );
        }
    }

    /**
     * Checks if the content has the shortcode in it
     * @access public
     */
    public function shortcode_exists() {
        global $post;
        if ( is_singular() ) {
            $this->shortcode_exists = has_shortcode( $post->post_content, 'webby-video' ) ? TRUE : FALSE;
            $this->shortcode_exists = apply_filters( 'smaart-video-shortcode-exists', $this->shortcode_exists, $post );
        }
    }

    /**
     * initialize the players on the page
     * @access public
     */
    public function initialize_players() {
        if ( isset( $this->players ) && count( $this->players ) > 0 ) {
            foreach ( $this->players as $player ) {
                require 'views/' . $player['provider'] . '.js.php';
            }
        }
    }

}
