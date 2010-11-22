<?php

// remove the default category listing
function childtheme_content($content) {
	if (is_category() || is_archive()) {
		$content= 'none';}
	return $content;
}
add_filter('thematic_content', 'childtheme_content');

// remove the index loop
function childtheme_override_index_loop($content) {
	
	/* Count the number of posts so we can insert a widgetized area */ $count = 1;
	while ( have_posts() ) : the_post();
	
			thematic_abovepost();
			
			if ( has_post_thumbnail() && !is_single()) {
				$content = '<a class="entry-thumb" href="' . get_permalink() . '" title="Permalink to ' . get_the_title() . '" >' . get_the_post_thumbnail(get_the_ID(), $size, $attr) . '</a>';
			}
			$pants_scene = get_post_custom_values('scene');
			$pants_sip = get_post_custom_values('sip');
			$pants_savor = get_post_custom_values('savor');
			$pants_sit = get_post_custom_values('sit');
			$pants_stilettos = get_post_custom_values('stilettos');
			$pants_spend = get_post_custom_values('spend');

			$content .= '<h4>pants at a glance</h4>

				  <ul class="ataglance">
						<li><strong>scene</strong>: ' . $pants_scene[0] . '</li>
						<li><strong>sip</strong>: ' . $pants_sip[0] . '</li>
						<li><strong>savor</strong>: ' . $pants_savor[0] . '</li>
						<li><strong>sit</strong>: ' . 	$pants_sit[0] . '</li>
						<li><strong>stilettos</strong>: ' . $pants_stilettos[0] . '</li>
						<li><strong>spend</strong>: ' . $pants_spend[0] . '</li>

				  </ul>
			';

			$content .= '<h4>pants picks</h4>
				  <p>';

			$tags = get_the_tags();
			if($tags) {
				$i = 1;
				foreach($tags as $tag) {
					$content .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
					if($i != count($tags)) {
						$content .= ',&nbsp;';
					}
					$i++;
				}
			}
			$content .= "<h4>unzipped</h4>";
			echo $content;
			
			?>

			<div id="post-<?php the_ID();
				echo '" ';
				if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
					post_class();
					echo '>';
				} else {
					echo 'class="';
					thematic_post_class();
					echo '">';
				}
 				thematic_postheader(); ?>
				<div class="entry-content">
<?php the_excerpt(); ?>
<a class="readmore" href="<?=the_permalink()?>">fully unzipped</a>
				<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'thematic') . '&after=</div>') ?>
				</div><!-- .entry-content -->
				<hr />
				<?php thematic_postfooter(); ?>
			</div><!-- #post -->

		<?php 
			
			thematic_belowpost();
			if(!is_page()) {
							comments_template();
			}


			if ($count==$thm_insert_position) {
					get_sidebar('index-insert');
			}
			$count = $count + 1;
	endwhile;

}
add_filter('thematic_index_loop', 'childtheme_override_index_loop');

//Get rid of the category page titles
function remove_page_title($content) {
	if (is_category()) {
		$content ='<div id="subheader">
			<h2>' . single_cat_title('', FALSE) . '</h2>
			' . category_description() . '
		</div>';
	} else if(is_archive()) {
		$content ='<div id="subheader">
			<h2>' . get_the_time('F Y') . '</h2>
			<p>Last seasons pants</p>
		</div>';
	} else if(is_home()) {
		$content ='<div id="subheader">
			<h2>Pants Posts</h2>
			<p>the latest news on food and booze</p>
		</div>';
	}
	$content .= '<div id="posts">';
	return $content;
}
add_filter('thematic_page_title','remove_page_title');

function custom_single_page_title() {
	echo '<div id="posts">';
}
add_filter('thematic_abovecontent', 'custom_single_page_title');

function add_new_category_listing() {
	global $post;
	if(is_category() || is_single() || is_archive()) {
		if ( has_post_thumbnail() && !is_single()) {
			$content = '<a class="entry-thumb" href="' . get_permalink() . '" title="Permalink to ' . get_the_title() . '" >' . get_the_post_thumbnail(get_the_ID(), $size, $attr) . '</a>';
		}
		$pants_scene = get_post_custom_values('scene');
		$pants_sip = get_post_custom_values('sip');
		$pants_savor = get_post_custom_values('savor');
		$pants_sit = get_post_custom_values('sit');
		$pants_stilettos = get_post_custom_values('stilettos');
		$pants_spend = get_post_custom_values('spend');
		
		$content .= '<h4>pants at a glance</h4>

			  <ul class="ataglance">
					<li><strong>scene</strong>: ' . $pants_scene[0] . '</li>
					<li><strong>sip</strong>: ' . $pants_sip[0] . '</li>
					<li><strong>savor</strong>: ' . $pants_savor[0] . '</li>
					<li><strong>sit</strong>: ' . 	$pants_sit[0] . '</li>
					<li><strong>stilettos</strong>: ' . $pants_stilettos[0] . '</li>
					<li><strong>spend</strong>: ' . $pants_spend[0] . '</li>
					
			  </ul>
		';
		
		$content .= '<h4>pants picks</h4>
			  <p>';
			
		$tags = get_the_tags();
		if($tags) {
			$i = 1;
			foreach($tags as $tag) {
				$content .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
				if($i != count($tags)) {
					$content .= ',&nbsp;';
				}
				$i++;
			}
		}
		if(!is_single()) {
			$content .= "<br /><br />" . get_the_excerpt();
			$content .= "</div><a href=\"" . get_permalink() . "\" class=\"readmore\">fully unzipped</a>";
		}

		$content .= "<hr />";
	}
	echo $content;
}
add_action('thematic_postfooter', 'add_new_category_listing');

// add custom image sizes
function add_custom_image_sizes() {
	set_post_thumbnail_size(401);
}
add_action('init', 'add_custom_image_sizes');

// add custom stylesheets
function add_custom_stylesheets() {
	
	if(!is_admin()) {
		wp_enqueue_style('yahoo-reset', 'http://yui.yahooapis.com/2.7.0/build/reset/reset-min.css');
		wp_enqueue_style('fonts', get_bloginfo('stylesheet_directory') . '/_css/fonts.css');
		wp_enqueue_style('main', get_bloginfo('stylesheet_directory') . '/_css/main.css');
		wp_enqueue_style('posts', get_bloginfo('stylesheet_directory') . '/_css/posts.css');
	}
	
}
add_action('init', 'add_custom_stylesheets');

// add custom javascript
function add_custom_javascript() {
	
	if(!is_admin()) {
		wp_enqueue_script('cufon-yui', get_bloginfo('stylesheet_directory') . '/_scripts/cufon-yui.js');
		wp_enqueue_script('meta', get_bloginfo('stylesheet_directory') . '/_scripts/Meta.js');
	}
}
add_action('init', 'add_custom_javascript');

// open inner wrapper, this is used to make the body background images work properly
function open_inner_wrapper() {
	echo '<div id="container">';
}
add_action('thematic_aboveheader', 'open_inner_wrapper');

// close inner wrapper, this is used to make the body background images work properly
function close_inner_wrapper() {
	echo "</div> <!-- /container -->";
}
add_action('thematic_below_footer', 'close_inner_wrapper');

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
		echo '<h4>unzipped</h4>';
	}
}
add_action('thematic_postheader', 'add_post_title', 4);

// create wonderlab header
function add_custom_header() {
	include('custom_header.php');
}
add_action('thematic_belowheader', 'add_custom_header');

// more containers
function add_custom_header2() {
	echo "</div>";
	
}
add_action('thematic_abovecontainer', 'add_custom_header2');

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


/* SISTERHOOD SPECIFIC FUNCTIONS */

// Wrapping the main area
function main_left_wrapper_open() {
	echo '<div id="main-left">';
	if(!is_category()) {
		if(in_category("pants-stance")) {
			echo "<img src=\"" . get_bloginfo('stylesheet_directory') . "/_images/header-pantsstance.jpg\" />";
		} else if(in_category("pants-rants")) {
			echo "<img src=\"" . get_bloginfo('stylesheet_directory') . "/_images/header-pantsrants.jpg\" />";
		}
	}

}
add_action('thematic_abovecontent', 'main_left_wrapper_open');

function main_left_wrapper_close() {
	echo '	</div>
		</div>';
}
add_action('thematic_belowcontent', 'main_left_wrapper_close');


// wrapping the sidebar area
function main_right_wrapper_open() {
	echo '<div id="main-right">';
}
add_action('thematic_abovemainasides', 'main_right_wrapper_open');

function main_right_wrapper_close() {
	echo '</div>';
}
add_action('thematic_belowmainasides', 'main_right_wrapper_close');

function single_post_header() {
	echo '<div class="post full pantsreviews">';
	global $post;
	if(!is_page()) {
		$restaurant_rating = get_post_custom_values('restaurant_rating');
		$restaurant_address = get_post_custom_values('restaurant_address');
		$restaurant_phone = get_post_custom_values('restaurant_phone');
		$restaurant_website = get_post_custom_values('restaurant_website');
		?>
		<div class="postheader">
			<p class="date"><?=get_the_date()?></p>
			<p class="title"><a href="<?=get_permalink()?>"><?=get_the_title()?></a></p>
			<p class="tagline">[Rating message <?=$restaurant_rating[0]?>]</p>
			<p class="contactinfo">
			<?=$restaurant_address[0]?><br />
			<?=$restaurant_phone[0]?><br />
			<a href=""><?=$restaurant_website[0]?></a><br />
			</p>
		</div>
		<p class="rating r<?=$restaurant_rating[0]?>"><?=$restaurant_rating[0]?></p>
	<?php
		if ( has_post_thumbnail() && is_single()) {
			echo get_the_post_thumbnail(get_the_ID(), $size, $attr);
		}
	} else if(is_page('the-sisters')) {
		echo "<img src=\"" . get_bloginfo('stylesheet_directory') . "/_images/header-sisters.jpg\" />";
	}
}
add_action("thematic_abovepost", "single_post_header");

function single_post_footer() {
	echo "</div>";
	// share code here
	// comments code here
}
add_action("thematic_belowpost", "single_post_footer");


?>