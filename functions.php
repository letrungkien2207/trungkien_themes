<?php
/**
@ Khai bao hang gia tri
	@ THEME_URL = lay duong dan thu muc theme
	@ CORE = lay duong dan cua thu muc /core
**/
define( 'THEME_URL', get_stylesheet_directory() );
define ( 'CORE', THEME_URL . "/core" );
/**
@ Nhung file /core/init.php
**/
require_once( CORE . "/init.php" );

/**
@ Thiet lap chieu rong noi dung
**/
if ( !isset($content_width) ) {
	$content_width = 620;
}

/**
@ Khai bao chuc nang cua theme 
**/
if ( !function_exists('trungkien_theme_setup') ) {
	function trungkien_theme_setup() {

		/* Thiet lap textdomain */
		$language_folder = THEME_URL . '/languages';
		load_theme_textdomain( 'trungkien', $language_folder );
		/* Tu dong them link RSS len <head> **/
		add_theme_support( 'automatic-feed-links' );

		/* Them post thumbnail */
		add_theme_support( 'post-thumbnails' );

		/* Post Format */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'quote',
			'link'
		) );

		/* Them title-tag */
		add_theme_support( 'title-tag' );

		/* Them custom background */
		$default_background = array(
			'default-color' => '#e8e8e8'
		);
		add_theme_support( 'custom-background', $default_background );

		/* Them menu */
		register_nav_menu( 'primary-menu', __('Primary Menu', 'trungkien') );
		register_nav_menu( 'top-menu', __('Top Menu', 'trungkien') );

		/* Tao sidebar */
		$sidebar = array(
			'name' => __('Main Sidebar', 'trungkien'),
			'id' => 'main-sidebar',
			'description' => __('Default sidebar'),
			'class' => 'main-sidebar',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		);
		register_sidebar( $sidebar );

	}
	add_action( 'init', 'trungkien_theme_setup' );
}


/*--------
TEMPLATE FUNCTIONS */
if (!function_exists('trungkien_logo')) {
	function trungkien_logo() { ?>
		<div id="site-name" class="col-sm-4">
			<?php
				global $tp_options;

				if( $tp_options['logo-on'] == 0 ) :
			?>
				<?php
					if ( is_home() ) {
						printf( '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );
					} else {
						printf( '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );			
					}
				?>

			<?php
				else : 
			?>
				<img src="<?php echo $tp_options['logo-image']['url']; ?>" />
		<?php endif; 
		?>
		</div>
		<?php
	}
}

/**
Thiet lap menu
**/
if ( !function_exists('trungkien_menu') ) {
	function trungkien_menu($menu) {
		$menu = array(
			'theme_location' => $menu,
			'container' => 'nav',
			'container_id' => $menu,
			'container_class' => $menu,
			'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
		);
		wp_nav_menu( $menu );
	}
}


if ( !function_exists('trungkien_main_menu') ) {
	function trungkien_main_menu($menu) {
		$menu = array(
			'theme_location' => $menu,
			'container' => 'nav',
			'container_id' => $menu,
			'container_class' => $menu .' navbar navbar-expand-lg navbar-light',
			'items_wrap' => '<div class="collapse navbar-collapse"><ul id="%1$s" class="%2$s navbar-nav mr-auto">%3$s</ul></div>'
		);
		wp_nav_menu( $menu );
	}
}
/**
Ham tao phan trang don gian
**/
if ( !function_exists('trungkien_pagination') ) {
	function trungkien_pagination() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return '';
		} ?>
		<nav class="pagination" role="navigation">
			<?php if ( get_next_posts_link() ) : ?>
				<div class="prev"><?php next_posts_link( __('Older Posts', 'trungkien') ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
				<div class="next"><?php previous_posts_link( __('Newest Posts', 'trungkien') ); ?></div>
			<?php endif; ?>
		</nav>
	<?php }
}

/**
Ham hien thi thumbnail 
**/
if ( !function_exists('trungkien_thumbnail') ) {
	function trungkien_thumbnail($size) {
		if( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image') ) : ?>
		<figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure>
	<?php endif; ?>
	<?php }
}

if ( !function_exists('trungkien_entry_header') ) {
	function trungkien_entry_header() { ?>
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
		<?php else : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
	<?php }
}

if ( !function_exists('trungkien_entry_meta') ) {
	function trungkien_entry_meta() { ?>
		<?php if ( !is_page() ) : ?>
			<div class="entry-meta">
			<?php
				printf( __('<span class="author">Posted by %1$s', 'trungkien'),
				get_the_author() );

				printf( __('<span class="date-published"> at %1$s', 'trungkien'),
				get_the_date() );

				printf( __('<span class="category"> in %1$s ', 'trungkien'),
				get_the_category_list( ',' ) );

				if ( comments_open() ) : 
					echo '<span class="meta-reply">';
						comments_popup_link(
							__('Leave a comment', 'trungkien'),
							__('One comment', 'trungkien'),
							__('% comments', 'trungkien'),
							__('Read all comments', 'trungkien')
							);
					echo '</span>';
				endif;
			?>
			</div>
		<?php endif; ?>
	<?php }
}

/**
trungkien_entry_content = ham hien thi noi dung cua post/page
**/
if ( !function_exists('trungkien_entry_content') ) {
	function trungkien_entry_content() {
		if( !is_single() && !is_page() ) {
			do_shortcode(the_excerpt());
		} else {
			do_shortcode(the_content());
		}
	}
}

function trungkien_readmore() {
	return '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'.__('...[Read More]', 'trungkien').'</a>';
}
add_filter('excerpt_more', 'trungkien_readmore');


/**
trungkien_entry_tag = hien thi tag 
**/
if ( !function_exists('trungkien_entry_tag') ) {
	function trungkien_entry_tag() {
		if ( has_tag() ) :
			echo '<div class="entry-tag">';
			printf( __('Tagged in %1$s', 'trungkien'), get_the_tag_list( '', ',' ) );
			echo '</div>';
		endif;
	}
}

if ( !function_exists('trungkien_social_menu') ) {
	function trungkien_social_menu() {
		global $tp_options;
		echo '<ul id="social">';
		echo '<li>
				<a href="'.$tp_options['fb-link'].'" target="_blank"><img src="'.get_template_directory_uri().'/less/images/fb.png" alt="facebook"></a>
			  </li>';
		echo '<li>
				<a href="'.$tp_options['youtube-link'].'" target="_blank"><img src="'.get_template_directory_uri().'/less/images/youtube.png" alt="youtube"></a>
			  </li>';
		echo '<li>
				<a href="tel:'.$tp_options['phone-link'].'" target="_blank"><img src="'.get_template_directory_uri().'/less/images/phone.png" alt="youtube">'.$tp_options['phone-link'].'</a>
			  </li>';	  
		echo '</ul>';
	}
}


/*=====Nhúng file style.css=====*/
function trungkien_style() {
	wp_register_style( 'main-style', get_template_directory_uri() . "/style.css", 'all' );
	wp_enqueue_style('main-style');

	wp_register_style( 'bootstrap-style', get_template_directory_uri() . "/less/css/bootstrap.min.css", 'all' );
	wp_enqueue_style('bootstrap-style');

	wp_register_script( 'bootstrap-script', get_template_directory_uri() . "/less/js/bootstrap.min.js", array('jquery') );
	wp_enqueue_script('bootstrap-script');	
}
add_action('wp_enqueue_scripts', 'trungkien_style');