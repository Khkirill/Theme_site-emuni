<?php
//include('app/function/acf-block-func.php');

define('FC_PATH_CSS', get_template_directory_uri() . '/app/css/');
define('FC_PATH_JS', get_template_directory_uri() . '/app/js/');
define('FC_PATH_IMG', get_template_directory_uri() . '/app/images/dist/');

////////////////// acf
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'General theme settings',
        'menu_title' => 'Emuni Solutions Themes Settings',
        'menu_slug' => 'options',
        'redirect' => false
    ));
}

$test = function ($attr) {
	$string = '<pre>' . var_dump($attr) . '</pre>' . exit;
	return $string;
};

//add exceprpt on page
add_action('init', function () {
	add_post_type_support('page', 'excerpt');
}, 10);


//add script and style
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script( 'jquery' );
    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), NULL, true);
    wp_enqueue_script('jquery');
//    || is_page()
    if (is_home() || is_front_page() ) {
        wp_enqueue_style('main', FC_PATH_CSS . 'main.min.css', array(), time());
    }elseif(is_single()){
        wp_enqueue_style('single-post', FC_PATH_CSS . 'single-post.min.css', array(), time());
    }elseif(is_category() || is_archive()){
        wp_enqueue_style('archive', FC_PATH_CSS . 'archive-category.min.css', array(), time());
    }else{
        wp_enqueue_style('other-pages', FC_PATH_CSS . 'other-pages.min.css', array(), time());
    }

//	wp_enqueue_script('parallax', FC_PATH_JS . '/common/parallax-bg.js', null, time(), true);
	wp_enqueue_script('app', FC_PATH_JS . 'app.min.js', null, time(), true);

}, 100);


add_action('after_setup_theme', function () {
	//add thumbs of pagw
	add_theme_support('post-thumbnails');
	//reg menus plase
	register_nav_menus([
		'header_left' => 'Header menu',
		'footer_menu_col-1' => 'Footer menu Column 1',
        'lang_menu' => 'Language menu',
	]);
});

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item','menu-item-has-children', 'menu-item')) : '';
}



//exit if accessed directly
if(!defined('ABSPATH')) exit;

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            /*
            if ( $args->has_children )
                $class_names .= ' dropdown';
            */

            if($args->has_children && $depth === 0) { $class_names .= ' dropdown'; } elseif($args->has_children && $depth > 0) { $class_names .= ' dropdown-submenu'; }

            if ( in_array( 'current-menu-item', $classes ) )
                $class_names .= ' active';

            // remove Font Awesome icon from classes array and save the icon
            // we will add the icon back in via a <span> below so it aligns with
            // the menu item
            if ( in_array('fa', $classes)) {
                $key = array_search('fa', $classes);
                $icon = $classes[$key + 1];
                $class_names = str_replace($classes[$key+1], '', $class_names);
                $class_names = str_replace($classes[$key], '', $class_names);

            }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->title )	? $item->title	: '';
            $atts['target'] = ! empty( $item->target )	? $item->target	: '';
            $atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

            // If item has_children add atts to a.
            // if ( $args->has_children && $depth === 0 ) {
            if ( $args->has_children ) {
                $atts['href']   		= '#';
                $atts['data-toggle']	= 'dropdown';
                $atts['class']			= 'dropdown-toggle';
            } else {
                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
            }

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            // Font Awesome icons
            if ( ! empty( $icon ) )
                $item_output .= '<a'. $attributes .'><span class="fa ' . esc_attr( $icon ) . '"></span>&nbsp;';
            else
                $item_output .= '<a'. $attributes .'>';

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {

            extract( $args );

            $fb_output = null;

            if ( $container ) {
                $fb_output = '<' . $container;

                if ( $container_id )
                    $fb_output .= ' id="' . $container_id . '"';

                if ( $container_class )
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ( $menu_id )
                $fb_output .= ' id="' . $menu_id . '"';

            if ( $menu_class )
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ( $container )
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }
}


add_filter('navigation_markup_template', function ($template, $class) {
return '
<nav class="pagination" role="navigation">
	<div class="pagination__list">%3$s</div>
</nav>
';
}, 10, 2);

/////////////////////////
// Отключаем любые CSS стили плагинов
function custom_dequeue(){
    wp_dequeue_style('wpml-legacy-dropdown-0');
    wp_dequeue_style('wpml-legacy-horizontal-list-0');
//    wp_deregister_style('cookie-law-info-gdpr');
    if(is_front_page() || is_category()){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );

//        wp_deregister_script( 'wp-embed' );
    }

}
add_action('wp_enqueue_scripts', 'custom_dequeue', 9999);
add_action('wp_head', 'custom_dequeue', 9999);
/////////////// disable emoji
function disable_wp_emoji() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emoji_tinymce' );
    // filter to remove DNS prefetch
    add_filter( 'emoji_svg_url', '__return_false' );
    //////////
    remove_action( 'wp_head', 'rest_output_link_wp_head');
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
    remove_action( 'template_redirect', 'rest_output_link_header', 11 );


    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'init', 'disable_wp_emoji' );

/////// disable header global-styles wp
function wps_deregister_styles() {
//    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

function disable_emoji_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}


/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2019.03.03
 * лицензия: MIT
*/
function dimox_breadcrumbs() {

    /* === ОПЦИИ === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
    $text['page']     =  'Page "%s"'; // текст 'Страница N'
    $text['cpage']    =  'Comments page "%s"'; // текст 'Страница комментариев N'

    $wrap_before    = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after     = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep            = '<span class="breadcrumbs__separator"></span>'; // разделитель между "крошками"
    $before         = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
    $after          = '</span>'; // тег после текущей "крошки"

    $show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url       = home_url('/');
    $link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</span>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
} // end of dimox_breadcrumbs()

// ALLOW SVG
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function common_svg_media_thumbnails($response, $attachment, $meta){
    if($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement'))
    {
        try {
            $path = get_attached_file($attachment->ID);
            if(@file_exists($path))
            {
                $svg = new SimpleXMLElement(@file_get_contents($path));
                $src = $response['url'];
                $width = (int) $svg['width'];
                $height = (int) $svg['height'];

                //media gallery
                $response['image'] = compact( 'src', 'width', 'height' );
                $response['thumb'] = compact( 'src', 'width', 'height' );

                //media single
                $response['sizes']['full'] = array(
                    'height'        => $height,
                    'width'         => $width,
                    'url'           => $src,
                    'orientation'   => $height > $width ? 'portrait' : 'landscape'
                );
            }
        }
        catch(Exception $e){}
    }

    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'common_svg_media_thumbnails', 10, 3);
// END ALLOW SVG

//disable contact form 7 tag p br
add_filter('wpcf7_autop_or_not', '__return_false');

////////// Отклбючаем Контакт форм везде оставляем только там где есть шорткод
function wpcf7_remove_assets() {
    add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );
}
add_action( 'wpcf7_init', 'wpcf7_remove_assets' );

function wpcf7_add_assets( $atts ) {
    wpcf7_enqueue_styles();
    wpcf7_enqueue_scripts();
    return $atts;
}
add_filter( 'shortcode_atts_wpcf7', 'wpcf7_add_assets' );
////////// конец Отклбючаем Контакт форм везде оставляем только там где есть шорткод
//
//function scanwp_buttons( $buttons ) {
//
//    array_unshift( $buttons, 'fontsizeselect' );
//    return $buttons;
//}
//add_filter( 'mce_buttons_2', 'scanwp_buttons' );

//// Customize mce editor font sizes
//if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
//    function wpex_mce_text_sizes( $initArray ){
//        $initArray['fontsize_formats'] = "10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 40px";
//        return $initArray;
//    }
//}
//add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );
//add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
//function my_toolbars( $toolbars )
//{
//    // Uncomment to view format of $toolbars
//    /*
//    echo '< pre >';
//        print_r($toolbars);
//    echo '< /pre >';
//    die;
//    */
//
//    // Add a new toolbar called "Very Simple"
//    // - this toolbar has only 1 row of buttons
//    $toolbars['Very Simple' ] = array();
//    $toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline' );
//
//    // Edit the "Full" toolbar and remove 'code'
//    // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
//    if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
//    {
//        unset( $toolbars['Full' ][2][$key] );
//    }
//
//    // remove the 'Basic' toolbar completely
//    unset( $toolbars['Basic' ] );
//
//    // return $toolbars - IMPORTANT!
//    return $toolbars;
//}
add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
     <script type="text/javascript">
         document.addEventListener( 'wpcf7mailsent', function( event ) {
         if ( '115' == event.detail.contactFormId ) { // Change 123 to the ID of the form
         jQuery('#form-popup-footer').addClass('visible'); //this is the bootstrap modal popup id
       }
        }, false );
         </script>
       <?php  }

/*
Plugin Name: Contact form 7 Custom validation
Plugin URI: http://resumedirectory.in
Description: Contact Form 7 validation messages provide custom error messages for each field.
Version: 1.0
Author: Aiyaz, maheshpatel
Author URI: http://resumedirectory.in
License: GPL2
*/

function action_cf7cv_save_contact_form( $contact_form )
{

    $tags = $contact_form->form_scan_shortcode();
    $post_id = $contact_form->id();

    foreach ($tags as $value) {

        if($value['type'] == 'text*' || $value['type'] == 'email*' || $value['type'] == 'textarea*' || $value['type'] == 'tel*'
            || $value['type'] == 'url*' || $value['type'] == 'checkbox*' || $value['type'] == 'file*'){
            $key = "_cf7cm_".$value['name']."-valid";
            $vals = sanitize_text_field($_POST[$key]);
            $all_meta_keys[] = $key;
            update_post_meta($post_id,$key, $value['name']);
        }

    }

}
add_action( 'wpcf7_save_contact_form', 'action_cf7cv_save_contact_form', 9, 1 );

function action_wpcf7_after_create( $instance )
{
    $tags = $instance->form_scan_shortcode();
    $post_id = $instance->id();

    foreach ($tags as $value) {

        if($value['type'] == 'text*' || $value['type'] == 'email*' || $value['type'] == 'textarea*' || $value['type'] == 'tel*'
            || $value['type'] == 'url*' || $value['type'] == 'checkbox*' || $value['type'] == 'file*'){
            $key = "_cf7cm_".$value['name']."-valid";
            $vals = sanitize_text_field($_POST[$key]);
            update_post_meta($post_id,$key, $value['name']);
        }
    }
}
add_action( 'wpcf7_after_create', 'action_wpcf7_after_create', 9, 1 );

function get_meta_values($p_id ='', $key = '') {

    global $wpdb;
    if( empty( $key ) )
        return;

    $r = $wpdb->get_results( "SELECT pm.meta_value FROM {$wpdb->postmeta} pm WHERE pm.meta_key LIKE '%$key%' AND pm.post_id = $p_id ");

    return $r;
}

function cf7cv_custom_validation_messages( $messages ) {

    if(isset($_GET['post']) && !empty($_GET['post']) ){

        $p_id = $_GET['post'];
        $p_val = get_meta_values($p_id, '_cf7cm');

        foreach ($p_val as $value) {
            $key = $value->meta_value;
            $newmsg = array(
                'description' => __( "Error message for $value->meta_value field", 'contact-form-7' ),
                'default' => __( "Please fill in the required field.", 'contact-form-7' ));

            $messages[$key] = $newmsg ;
        }

    }
    return $messages;
}

add_filter( 'wpcf7_messages', 'cf7cv_custom_validation_messages', 10, 1 );

function cf7cv_custom_form_validation($result,$tag) {
    $type = $tag['type'];
    $name = $tag['name'];
    $check_empty = wpcf7_get_message( $name );
    if(empty($check_empty )){
        $name="invalid_required";
    }
    if($type == 'text*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'email*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'email*' && $_POST[$name] != '') {
        if(substr($_POST[$name], 0, 1) == '.' ||
            !preg_match('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST[$name])) {
            $result->invalidate( $name, wpcf7_get_message($name) );
        }
    }
    if($type == 'textarea*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'tel*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'url*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'checkbox*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }
    if($type == 'file*' && $_POST[$name] == ''){
        $result->invalidate( $name, wpcf7_get_message( $name ) );
    }

    return $result;
}

add_filter('wpcf7_validate_text*', 'cf7cv_custom_form_validation', 10, 2); // Req. text field
add_filter('wpcf7_validate_email*', 'cf7cv_custom_form_validation', 10, 2); // Req. email field
add_filter('wpcf7_validate_textarea*', 'cf7cv_custom_form_validation', 10, 2); // Req. textarea field
add_filter('wpcf7_validate_tel*', 'cf7cv_custom_form_validation', 10, 2); // Req. telephone field
add_filter('wpcf7_validate_url*', 'cf7cv_custom_form_validation', 10, 2); // Req. URL field
add_filter('wpcf7_validate_checkbox*', 'cf7cv_custom_form_validation', 10, 2); // Req. checkbox field
add_filter('wpcf7_validate_file*', 'cf7cv_custom_form_validation', 10, 2); // Req. File field

