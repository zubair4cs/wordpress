<?php
add_action( 'after_setup_theme', 'ikonic_setup' );
function ikonic_setup() {
 
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
 
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'ikonic' ) ) );
}
 
add_action( 'wp_enqueue_scripts', 'ikonic_enqueue_more' );
function ikonic_enqueue_more() {
wp_enqueue_style( 'ikonic-style2', get_stylesheet_uri() );
 
}

add_action( 'wp_enqueue_scripts', 'ikonic_enqueue' );

function ikonic_enqueue() {



    if ( ! is_admin() ) {



        wp_dequeue_style( 'wp-block-library-css' ); // Remove editor block CSS 
		
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/plugins/bootstrap/css/bootstrap.min.css');

        wp_enqueue_style( 'themify-icons-style', get_template_directory_uri().'/plugins/themify/css/themify-icons.css');

        wp_enqueue_style( 'all-css-style', get_template_directory_uri().'/plugins/fontawesome/css/all.css');
		
		wp_enqueue_style( 'magnific-popup-style', get_template_directory_uri().'/plugins/magnific-popup/dist/magnific-popup.css');
		
		wp_enqueue_style( 'video-style', get_template_directory_uri().'/plugins/modal-video/modal-video.css');
		
		wp_enqueue_style( 'animate-style', get_template_directory_uri().'/plugins/animate-css/animate.css');
		
		wp_enqueue_style( 'slick-style', get_template_directory_uri().'/plugins/slick-carousel/slick/slick.css');
		
		wp_enqueue_style( 'slick-theme-style', get_template_directory_uri().'/plugins/slick-carousel/slick/slick-theme.css');
		
		wp_enqueue_style( 'style-theme-style', get_template_directory_uri().'/css/style.css');

     
      

    // Bootstrap
    wp_enqueue_script('bootstrap-popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.js', ['jquery'], null, true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', ['bootstrap-popper'], null, true);

    // Magnific Popup
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/plugins/magnific-popup/dist/jquery.magnific-popup.min.js', ['jquery'], null, true);

    // Slick Slider
    wp_enqueue_script('slick-slider', get_template_directory_uri() . '/plugins/slick-carousel/slick/slick.min.js', ['jquery'], null, true);

    // Counterup
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.min.js', ['jquery'], null, true);
    wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', ['waypoints'], null, true);

    // Modal Video
    wp_enqueue_script('modal-video', get_template_directory_uri() . '/plugins/modal-video/modal-video.js', ['jquery'], null, true);

    // Google Maps
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap', [], null, true);
    wp_enqueue_script('map-init', get_template_directory_uri() . '/plugins/google-map/map.js', ['google-maps'], null, true);

    // Main Scripts
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/script.js', ['jquery'], null, true);
    wp_enqueue_script('contact-script', get_template_directory_uri() . '/js/contact.js', ['jquery'], null, true);		
   
    }
}

function register_my_menu() {
    register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('init', 'register_my_menu');
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth Depth of menu item. Used for padding.
     * @param array  $args An array of arguments. @see wp_nav_menu().
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n";
    }

    /**
     * Starts the element output.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param WP_Post $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param array $args An array of arguments. @see wp_nav_menu().
     * @param int $id Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';

        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }
        if ($depth && in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown-submenu';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        if (in_array('menu-item-has-children', $classes)) {
            $atts['data-toggle'] = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['class'] = 'nav-link dropdown-toggle';
        } else {
            $atts['class'] = 'nav-link';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}
function post_type_projects() {
$labels = array(
    'name' => _x('Projects', 'post type general name', 'agrg'),
    'singular_name' => _x('projects', 'post type singular name', 'agrg'),
    'add_new' => _x('Add New Project', 'pharmacie', 'agrg'),
    'add_new_item' => __('Add New Project', 'agrg'),
    'edit_item' => __('Edit Project', 'agrg'),
    'new_item' => __('New Project', 'agrg'),
    'view_item' => __('View Projects', 'agrg'),
    'search_items' => __('Search Projects', 'agrg'),
    'not_found' =>  __('No Project found', 'agrg'),
    'not_found_in_trash' => __('No Project found in Trash', 'agrg'), 
    'parent_item_colon' => ''
);

$args = array(
	'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => false,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => null,
	'has_archive' => true,
    'menu_icon' => 'dashicons-book',
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'page-attributes' )
);

register_post_type( 'projects', $args );
flush_rewrite_rules(false);

}
add_action('init', 'post_type_projects');


function project_taxonomy() {
    register_taxonomy( 'project-type', array( 'projects' ),
        array(
            'labels' => array(
                'name'              => 'Project Category',
                'singular_name'     => 'Project Category',
                'search_items'      => 'Search Project Category',
                'all_items'         => 'All Project Categories',
                'edit_item'         => 'Edit Project Category',
                'update_item'       => 'Update Project Category',
                'add_new_item'      => 'Add New Project Category',
                'new_item_name'     => 'New Project Category Name',
                'menu_name'         => 'Project Categories',
            ),
            'hierarchical' => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite' => array('slug' => 'project-type' )
        )
    );
}
add_action( 'init', 'project_taxonomy' );
 
function redirect_users_by_ip() {
  
    $user_ip = '';
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $user_ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    
        $user_ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    } else {
         
        $user_ip = $_SERVER['REMOTE_ADDR'];
    } 
    $user_ip = apply_filters('wp_remote_ip', $user_ip);

    // Check if the IP starts with '77.29'
    if (strpos($user_ip, '77.29') === 0) {
         
        wp_safe_redirect(home_url('/access-denied')); // Replace with your preferred URL
        exit;
    }
}
add_action('template_redirect', 'redirect_users_by_ip'); 

add_action('init', function() {
    add_rewrite_rule(
        '^project-type/([^/]+)/?$',
        'index.php?project-type=$matches[1]',
        'top'
    );
    flush_rewrite_rules();
});
function set_projects_posts_per_page($query) {
 
 
     if (!is_admin() && $query->is_main_query()) {
        // Check if it's an archive page for the 'projects' post type
        if (is_tax('project-type')) {
             
            $query->set('posts_per_page', 6);
        }
    }
}
add_action('pre_get_posts', 'set_projects_posts_per_page');



add_action('wp_enqueue_scripts', function() { 
	wp_enqueue_script('architecture-projects-ajax', get_template_directory_uri() . '/js/architecture-projects.js', ['jquery'], null, true);
	wp_localize_script('architecture-projects-ajax', 'architectureProjectsAjax', [ 'ajax_url' => admin_url('admin-ajax.php'), ]);
 });
 
add_action('wp_ajax_get_architecture_projects', 'get_architecture_projects'); 
add_action('wp_ajax_nopriv_get_architecture_projects', 'get_architecture_projects'); 
 function get_architecture_projects() {
  $posts_per_page = is_user_logged_in() ? 6 : 3;
$args = [ 'post_type' => 'projects',
               'posts_per_page' => $posts_per_page,
               'tax_query' => [ [ 'taxonomy' => 'project-type', 'field' => 'slug', 'terms' => 'test', ], ], 
               'post_status' => 'publish', 
             ]; 
  $query = new WP_Query($args); 
	if ($query->have_posts()) {
		$projects = [];
		while ($query->have_posts()) {
					 $query->the_post();
					$projects[] = [ 'id' => get_the_ID(), 'title' => get_the_title(), 'link' => get_permalink(), ];
		}
	   wp_send_json([ 'success' => true, 'data' => $projects, ]);
	}
	wp_die(); 
}


function testapi(){
$quotes = []; 
  for ($i = 0; $i < 5; $i++) { 
    $response = wp_remote_get('https://api.kanye.rest/');
    $body = wp_remote_retrieve_body($response); 
    $data = json_decode($body, true);
 
    if (isset($data['quote'])) { 
     $quotes[] = $data['quote']; 
    } 
}

return $quotes;	
}
 
?>
