<?php 
@define( 'IRON_PARENT_DIR', get_template_directory() );
@define( 'IRON_CHILD_DIR',  get_stylesheet_directory() );
	
@define( 'IRON_PARENT_URL', get_template_directory_uri() );
@define( 'IRON_CHILD_URL',  get_stylesheet_directory_uri() );

$iron_post_types = array();
$iron_query = (object) array();
$use_dashicons = floatval($wp_version) >= 3.8;

require_once('inc/advanced-custom-fields/acf.php');
include('inc/custom-fields.php');
include('inc/custom-posttypes.php');
include('inc/klantenvertellen.php');

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu', 'magneet-online' ));
}
add_action( 'init', 'register_my_menu' );

register_sidebar($args = array(
	'name'          => sprintf( __( 'Sidebar', 'magneet-online' )),
	'id'            => "sidebar",
	'description'   => '',
	'class'         => '',
	'before_widget' => '<div id="%1$s" class="sidebar--widget sidebar--widget__%2$s">',
	'after_widget'  => "</div>\n",
	'before_title'  => '<h3 class="sidebar--widget__title">',
	'after_title'   => "</h3>\n",
));
register_sidebars(3, array('name'=>'Footer kolom %d', 'id'=>'footer'));

function sample_admin_notice__success() {
    global $current_user;
    get_currentuserinfo();
    $admin_usr = "magneet_admin";
    $curr_user = $current_user->user_nicename;
    if($curr_user == $admin_usr){
	    ?>
	    <div class="notice notice-warning">
	        <p><?php _e( "Thema aanpassingen gelieve te doen in de PHP, SASS en Coffeescript files op de <a href='https://bitbucket.org/magneetonline/stamco' target='_blank'>bitbucket repository.</a> <br><small>Deze melding is alleen te zien voor {$admin_usr}</small>");?></p>
	    </div>
	    <?php
	}
}
add_action( 'admin_notices', 'sample_admin_notice__success' );
add_image_size("archive-thumb", 720, 485, true);
add_action('wp_head','hook_css');
function hook_css() {
	global $post;
	if(get_field('gallerij', $post->ID)){
		foreach(get_field('gallerij') as $photo){
			echo "<link rel=\"preload\" href=\"{$photo['url']}\">";
		}
	}
}
function add_theme_scripts() {
	$rev_files = array_reverse(json_decode(file_get_contents(get_template_directory()."/dist/rev-manifest.json"), true));
	foreach($rev_files as $key => $item){
		if($_SERVER['HTTP_HOST'] != "comfort.sem" ){
			if(pathinfo($item, PATHINFO_EXTENSION) == "css"){
				wp_enqueue_style(pathinfo($item, PATHINFO_FILENAME), get_template_directory_uri() ."/dist/". $item);
			}elseif(pathinfo($item, PATHINFO_EXTENSION) == "js"){
				wp_enqueue_script( pathinfo($item, PATHINFO_FILENAME), get_template_directory_uri() ."/dist/". $item, '', '', true);
			}
		}else{
			if(pathinfo($key, PATHINFO_EXTENSION) == "css"){
				wp_enqueue_style("dev-".pathinfo($key, PATHINFO_FILENAME), get_template_directory_uri() ."/". $key);
			}elseif(pathinfo($key, PATHINFO_EXTENSION) == "js"){
				wp_enqueue_script( "dev-".pathinfo($key, PATHINFO_FILENAME), get_template_directory_uri() ."/". $key, '', '', true);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

