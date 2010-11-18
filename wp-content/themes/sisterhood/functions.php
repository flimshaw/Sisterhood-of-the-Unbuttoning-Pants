<?php

// turn off all post comments
function turn_off_comments() {
	global $post;
	$post->comment_status = "closed";
}
add_filter('get_header', 'turn_off_comments');

// kill nav above and nav below, as well as footertext
function kill_next_prev_nav() {
	remove_action('thematic_navigation_above', 'thematic_nav_above', 2);
	remove_action('thematic_navigation_below', 'thematic_nav_below', 2);
	
	remove_action('thematic_footer', 'thematic_siteinfoopen', 20);
	remove_action('thematic_footer', 'thematic_siteinfo', 30);
	remove_action('thematic_footer', 'thematic_siteinfoclose', 40);
}
add_filter('init', 'kill_next_prev_nav');

// remove the standard thematic header junk
function remove_default_thematic_header() {
	remove_action('thematic_header','thematic_brandingopen',1);
	remove_action('thematic_header', 'thematic_blogtitle', 3);
	remove_action('thematic_header','thematic_blogdescription',5);
	remove_action('thematic_header','thematic_brandingclose',7);
	remove_action('thematic_header','thematic_access',9);
}
add_action('init', 'remove_default_thematic_header');

// deregister all the standard thematic sidebars except the primary aside
function remove_sidebars() {
		//unregister_sidebar('primary-aside');
		unregister_sidebar('secondary-aside');
		unregister_sidebar('1st-subsidiary-aside');
		unregister_sidebar('2nd-subsidiary-aside');
		unregister_sidebar('3rd-subsidiary-aside');
		unregister_sidebar('index-top');
		unregister_sidebar('index-bottom');
		unregister_sidebar('single-top');
		unregister_sidebar('single-insert');
		unregister_sidebar('single-bottom');
		unregister_sidebar('index-insert');
		unregister_sidebar('page-top');
		unregister_sidebar('page-bottom');
	}
add_action( 'admin_init', 'remove_sidebars');

// register custom sidebars
function create_sidebars() {
	// Homepage sidebars
	register_sidebar(array(
		'name' => 'Sample Custom Sidebar',
		'id' => 'sample-custom-sidebar',
		'description' => 'Custom sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>'
	));
}
add_action( 'init', 'create_sidebars');

// create shortcode for displaying custom sidebars, enter the sidebar slugs comma-seperated
function sidebars_shortcode($args) {
	$sidebar_contents = ""; // blank out our contents holder
	$sidebar_array = explode(',', $args['slugs']); // explode our argument into an array of sidebars
	ob_start();
	foreach($sidebar_array as $sidebar_slug) {
		echo '<div id="sidebar_' . $sidebar_slug . '" class="sidebar-container">
		<ul class="xoxo">';
		dynamic_sidebar($sidebar_slug);
		$sidebar_contents = ob_get_contents();
		echo '</ul>
		</div>';	
	}
	ob_end_clean();
	return $sidebar_contents;
}
add_shortcode('get_sidebars', 'sidebars_shortcode');

// create simple blank widget for 2col custom stories
/**
 * TwoColumnStoryWidget Class
 */
class SampleWidget extends WP_Widget {
	/** constructor */
	function SampleWidget() {
		parent::WP_Widget(false, $name = 'Sample Widget');
	}
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$body_text = apply_filters('story_id', $instance['body_text']);
        ?>
              <?php echo $before_widget; 
			  // here's where the fun stuff happens ?>
			  <div class="widget-outer-wrapper">
				<div class="widget-inner-wrapper">
					<?=$body_text?>
			    </div> <!-- /widget-inner-wrapper -->
			  </div> <!-- /widget-outer-wrapper -->
              <?php echo $after_widget; ?>
        <?php
    }
    
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['body_text'] = strip_tags($new_instance['body_text']);
        return $instance;
    }

	/** @see WP_Widget::form */
    function form($instance) {				
        $body_text = esc_attr($instance['body_text']);
        ?>
            <p><label for="<?php echo $this->get_field_id('story_id'); ?>"><?php _e('Body:'); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('body_text'); ?>" name="<?php echo $this->get_field_name('body_text'); ?>"><?php echo $body_text; ?></textarea></label></p>
        <?php 
    }

} // class FooWidget
// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("SampleWidget");'));


// get rid of the entry utility links under each post
function kill_entry_utility($content) {
	$content = '';
	return $content;
}
add_filter('thematic_postfooter', 'kill_entry_utility');

// add title to detail screen
function add_post_title() {
	if(is_single()) { // if we're on a single post
		global $post;
		echo '<h1 class="entry-title"><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></h1>';
	}
}
add_action('thematic_postheader', 'add_post_title', 4);

// create wonderlab header
function add_custom_header() {
	include('custom_header.php');
}
add_action('thematic_header', 'add_custom_header');

// remove default footer
function remove_default_footer() {
	return false;
}
add_filter('thematic_footertext', 'remove_default_footer');

// create wonderlab footer
function add_custom_footer() {
	include('custom_footer.php');
}
add_action('thematic_after', 'add_custom_footer');




?>