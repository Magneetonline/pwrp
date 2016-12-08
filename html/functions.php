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
add_image_size("magneet_blog_img", 1024, 683, true);
function blogs_func( $atts ) {
    $html = "<div class=\"wpb_column vc_column_container vc_col-sm-12\">
   <div class=\"vc_column-inner \">
      <div class=\"wpb_wrapper\">
         <div class=\"vc_row wpb_row vc_inner vc_row-fluid\">";
    
    $loop = new WP_Query('showposts=3&orderby=ID&order=DESC');
    if($loop->have_posts()): while($loop->have_posts()): $loop->the_post();
    //die(var_dump(   the_post_thumbnail('1024x683')   ));     
    	$html .= "<div class=\"wpb_column vc_column_container vc_col-sm-4\">
               <div class=\"vc_column-inner \">
                  <div class=\"wpb_wrapper\">
                     <div class=\"wpb_text_column wpb_content_element \">
                        <div class=\"wpb_wrapper\">
                           <h4><span style=\"color: #575656;\"><strong>". get_the_title()."</strong></span></h4>
                        </div>
                     </div>
                     <div class=\"wpb_single_image wpb_content_element vc_align_center\">
                        ".get_the_post_thumbnail(get_the_ID(), 'magneet_blog_img')."
                     </div>
                     <div class=\"wpb_text_column wpb_content_element \">
                        <div class=\"wpb_wrapper\">
                           <h6>".get_the_date()."</h6>
                           <p><span style=\"color: #575656;\">".get_the_excerpt()."</span><br>
                               <a href=\"".get_the_permalink()."\"><span style=\"color: #575656;\">&gt;&gt; Lees meer </span></a>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>";
    endwhile; else:
    	$html .= "No recent posts yet!";
    endif;
    
    $html .= "         </div>
      </div>
   </div>
</div>";

    return "$html";
}
add_shortcode( 'get_blogs', 'blogs_func' );

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

