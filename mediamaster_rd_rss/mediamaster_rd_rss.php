<?php
/*
Plugin Name: Mediamaster Reader Rss
Plugin Script: mediamaster_rd_rss.php
Plugin URI: http://www.mediamaster.eu/mediamaster_rd_rss.zip/
Description: Reader rss for your blog with set options in admin area
Version: 1.0
License: GPL
Author: Francesco De Stefano
Author URI: http://www.mediamaster.eu

=== RELEASE NOTES ===
2013-01-23 - v1.0 - first version
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/

// mediamaster_rd_rss parameters 
function mediamaster_rd_rss($content)
{
    $return = $content;
    $return .= '
    <h1>' . get_option('mRSS_input_titlerss') . '</h1>
    <div id="divRss"></div> 
    <p class="author_plugin">Plugin Mediamaster Reader Rss: <a href="http://ulmdesign.mediamaster.eu">NewUlmDesign</a> Francesco De Stefano</p>';
    return $return;
}
add_shortcode( 'rssMediamaster', 'mediamaster_rd_rss' );
add_filter('the_content', 'do_shortcode', 'mediamaster_rd_rss');
add_filter('widget_text', 'do_shortcode', 'mediamaster_rd_rss');
add_filter('wp_list_pages', 'do_shortcode', 'mediamaster_rd_rss');
wp_enqueue_style('rd_rss_style', WP_PLUGIN_URL . '/mediamaster_rd_rss/style/style.css');
wp_enqueue_script('rd_rss_script', WP_PLUGIN_URL . '/mediamaster_rd_rss/js/rss_reader.js', array('jquery'));
wp_enqueue_script('rd_rss_script_rd', WP_PLUGIN_URL . '/mediamaster_rd_rss/js/main.js', array('jquery'));



//setting options
function mRSS_activate_set_default_options()
{
    add_option('mRSS_input_url', 'Insert url');
	add_option('mRSS_input_maxcount', '5');
	add_option('mRSS_input_showdate', '');
	add_option('mRSS_input_titlerss', '');
	add_option('mRSS_input_showauthor', '');
	add_option('mRSS_input_showtags', '');
	add_option('mRSS_change_colorTitle', '');
	add_option('mRSS_change_colorContents', '');
	add_option('mRSS_change_colorBackground', '');
	add_option('mRSS_change_colortextAuthor', '');
	add_option('mRSS_change_colorTags', '');
	add_option('mRSS_change_colorDate', '');
}
 
register_activation_hook( __FILE__, 'mRSS_activate_set_default_options');

// register setting
function mRSS_register_options_group()
{
    register_setting('mRSS_options_group', 'mRSS_input_url');
	register_setting('mRSS_options_group', 'mRSS_input_maxcount');
	register_setting('mRSS_options_group', 'mRSS_input_showdate');
	register_setting('mRSS_options_group', 'mRSS_input_titlerss');
	register_setting('mRSS_options_group', 'mRSS_input_showauthor');
	register_setting('mRSS_options_group', 'mRSS_input_showtags');
	register_setting('mRSS_options_group', 'mRSS_change_colorTitle');
	register_setting('mRSS_options_group', 'mRSS_change_colorContents');
	register_setting('mRSS_options_group', 'mRSS_change_colorBackground');
	register_setting('mRSS_options_group', 'mRSS_change_colortextAuthor');
	register_setting('mRSS_options_group', 'mRSS_change_colorTags');
	register_setting('mRSS_options_group', 'mRSS_change_colorDate');
}
 
add_action('admin_init', 'mRSS_register_options_group');

//page with form
function m_update_rss_options_form()
{
    ?>
    <div class="wrap">
    	<div class="icon32" id="icon-options-general"></div><br>
    	<h3>Setting Rss Reader plugin Mediamaster</h3>
    	<form method="post" action="options.php"><?php settings_fields('mRSS_options_group'); ?>
    		<label for="mRSS_input_titlerss">Title Rss:</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_titlerss'); ?>" id="mRSS_input_titlerss"  name="mRSS_input_titlerss"/></p>
    		<label for="mRSS_input_url">Url RSS:</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_url'); ?>" id="mRSS_input_url"  name="mRSS_input_url"/></p>
    		<p>
    		<label for="mRSS_input_maxcount">Max Count:</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_maxcount'); ?>" id="mRSS_input_maxcount"  name="mRSS_input_maxcount"/></p>
    		</p>
    		<p>
    		<label for="mRSS_input_showdate">Show Date - Type Option: block or none *</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_showdate'); ?>" id="mRSS_input_showdate"  name="mRSS_input_showdate"/></p>
    		</p>
    		<p>
    		<label for="mRSS_input_showauthor">Show Author - Type Option: block or none *</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_showauthor'); ?>" id="mRSS_input_showauthor"  name="mRSS_input_showauthor"/></p>
    		</p>
    		<p>
    		<label for="mRSS_input_showtags">Show Tags - Type Option: block or none *</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_input_showtags'); ?>" id="mRSS_input_showtags"  name="mRSS_input_showtags"/></p>
    		</p>
    		<p>* block = show element</p>
    		<p>* none = remove element</p>
    		<hr>
    		<h3>Custom Style</h3>
    		<p>
    		<label for="mRSS_change_colorTitle">Change Color Title</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colorTitle'); ?>" id="mRSS_change_colorTitle"  name="mRSS_change_colorTitle"/></p>
    		</p>
    		<p>
    		<label for="mRSS_change_colorContents">Change Color Contents</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colorContents'); ?>" id="mRSS_change_colorContents"  name="mRSS_change_colorContents"/></p>
    		</p>
    		<p>
    		<label for="mRSS_change_colorDate">Change Color Date</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colorDate'); ?>" id="mRSS_change_colorDate"  name="mRSS_change_colorDate"/></p>
    		</p>
    		<p>
    		<label for="mRSS_change_colorTags">Change Color Tags</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colorTags'); ?>" id="mRSS_change_colorTags"  name="mRSS_change_colorTags"/></p>
    		</p>
    		<p>
    		<label for="mRSS_change_colortextAuthor">Change Color Author post</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colortextAuthor'); ?>" id="mRSS_change_colortextAuthor"  name="mRSS_change_colortextAuthor"/></p>
    		</p>
    		<p>
    		<label for="mRSS_change_colorBackground">Change Color Background</label>
    		<p><input style="width: 300px" type="text" value="<?php echo get_option('mRSS_change_colorBackground'); ?>" id="mRSS_change_colorBackground"  name="mRSS_change_colorBackground"/></p>
    		</p>
    		<span><a href="http://www.w3schools.com/tags/ref_colorpicker.asp" target="_blank">Color Picker here</a></span>
    		<p><input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes'); ?>"/></p>
    		<legend>For to see Feed insert in your post or widget text or page this shortcode: [rssMediamaster]</legend>
    	</form>
    	<p>Plugin Mediamaster Reader Rss: <a href="http://ulmdesign.mediamaster.eu">NewUlmDesign</a> Francesco De Stefano</p>
    </div>
    <?php
}

// custom menu admin
function mediamaster_rd_rss_opt_page()
{
    add_menu_page('M-RSS-Reader', 'M-RSS-Reader', 'administrator', 'rd_rss-options-page', 'm_update_rss_options_form');
}

add_action('admin_menu', 'mediamaster_rd_rss_opt_page');

function mRSS_dinamic_style()
{
    ?>
        <style>
        .Data{display:<?php echo get_option('mRSS_input_showdate'); ?>;}
        .autorepost{display:<?php echo get_option('mRSS_input_showauthor'); ?>;}
        .tags{display:<?php echo get_option('mRSS_input_showtags'); ?>;}
        .Titolo a {color: <?php echo get_option('mRSS_change_colorTitle');?>}
        .Contenuti{color: <?php echo get_option('mRSS_change_colorContents');?>}
        .autorepost{color: <?php echo get_option('mRSS_change_colortextAuthor');?>}
        .tags{color: <?php echo get_option('mRSS_change_colorTags');?>}
        .Data{color: <?php echo get_option('mRSS_change_colorDate');?>}
        #divRss{background-color: <?php echo get_option('mRSS_change_colorBackground');?>}
        </style>
    <?php
}
 
add_action('wp_head', 'mRSS_dinamic_style');


//custom script
function mRSS_print_javascript_var()
{
    ?>
    <script type="text/javascript">
            var FeedUrl = '<?php echo get_option('mRSS_input_url'); ?>';
            var MaxCount = '<?php echo get_option('mRSS_input_maxcount'); ?>';
            var showDate = '<?php echo get_option('mRSS_input_showdate'); ?>';
	   jQuery(document).ready(function($){
	    $('#submit').click(function(){
	        $('#divRss').wpRssMediamaster({
			   FeedUrl : $('#mRSS_input_url').val(),
			   MaxCount : $('#mRSS_input_maxcount').val(),
			   ShowDesc : showDescription,
			   ShowPubDate: showDate
	  		});
	   		});
		});
		
       </script>
<?php

}

add_action ('wp_print_scripts', 'mRSS_print_javascript_var');
?>