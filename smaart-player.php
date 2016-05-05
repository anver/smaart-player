<?php

namespace SMAARTWEB\SmaartPlayer;

use SMAARTWEB\SmaartPlayer\Admin\SmaartPlayerAdmin;
use SMAARTWEB\SmaartPlayer\Front\SmaartPlayerPublic;

/** بسم الله الرحمن الرحيم **
 *
 * Plugin Name: Smaart Player
 * Plugin URI: http://www.smaartweb.com
 * Version: 1.0
 * Description: Smart video player using videojs javascript engine
 * Author: Anver
 * Author URI: http://smaartweb.com
 * Domain Path: /languages/
 * Text Domain: smaart-player
 *
 * -------------------------------------------------------------------------------
 * Copyright (c) 2016 SmaartWeb. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

class SmaartPlayer {

    /**
     * Default constructor
     * @access public
     */
    public function __construct() {
        $admin = new SmaartPlayerAdmin();
        $public = new SmaartPlayerPublic();
    }

}

$SmaartPlayer = new SmaartPlayer();
