<?php
require get_theme_file_path('/inc/search-route.php');
function wajeeh_custom_rest(){
register_rest_field('post','authorName',array(
'get_callback'=>function(){return get_the_author();}
));
}
add_action('rest_api_init','wajeeh_custom_rest');
function pageBanner($args =NULL){
	//php logical will live here
	if(! $args['title']){
$args['title']=get_the_title();
	}
	if(! $args['subtitle']){
$args['subtitle']=get_field('page_banner_subtitle');
	}
	if(! $args['photo']){
		if(get_field('page_banner_background_image')){
$args['photo']=get_field('page_banner_background_image')['sizes']['pageBanner'];
		}else{
			$args['photo']=get_theme_file_uri('/images/ocean.jpg');
		}
	}
	?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 

echo $args['photo'];
      ?>);"></div>
    <div class="page-banner__content container container--narrow">

      <h1 class="page-banner__title"><?php echo $args['title']?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']?></p>
      </div>
    </div>  
  </div>

	<?php
}

function wajeeh_files(){
wp_enqueue_script('main-wajeeh-js',get_theme_file_uri('/js/scripts-bundled.js'),
NUL,microtime(),true);
wp_enqueue_script('main-wajeeh3-js',get_theme_file_uri('/js/jquery.js'),
NUL,microtime(),true);

wp_enqueue_script('main-wajeeh2-js',get_theme_file_uri('/js/main.js'),
NUL,microtime(),true);
wp_enqueue_style('custom-google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
wp_enqueue_style('wajeeh_main_styles',get_stylesheet_uri(),NULL,microtime());
wp_localize_script('main-wajeeh2-js','secondWajeeh',array(
    'root_url'=>get_site_url(),
));
}
add_action('wp_enqueue_scripts','wajeeh_files');

function wajeeh_features(){
/**add menu deinic
register_nav_menu('headerMenuLocation','Header Menu Location');
register_nav_menu('footerLicationOne','Footer Location One');
register_nav_menu('footerLicationTwo','Footer Location Two');*/
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	//image size
	add_image_size('professorLandscape',400,260,true);
	add_image_size('professorPortrail',480,650,true);
	add_image_size('pageBanner',1500,350,true);
}
//to change the title tag
add_action('after_setup_theme','wajeeh_features');
//to get event is finsh 
function wajeeh_adject_query($query){

if(!is_admin() and is_post_type_archive('campus') and $query->is_main_query()){	
$query->set('posts_per_page',-1);
}
if(!is_admin() and is_post_type_archive('program') and $query->is_main_query()){
$query->set('orderby','title');
$query->set('order','ASC');
$query->set('posts_per_page',-1);
}
	//to make controll in event page not all page
if(!is_admin() and is_post_type_archive('event') and $query->is_main_query()){
        $tody=date('Ymd');
		$query->set('meta_key','event_date');
		$query->set('orderby','meta_value_num');
		$query->set('order','ASC');
		$query->set('meta_query',array(
  array(
 'key'=>'event_date',
   'compare'=>'>=',
   'value'=>$tody,
   'type'=>'numeric',
  ),
));
	}
}
add_action("pre_get_posts",'wajeeh_adject_query');

//redirect subscribe accounts out of admin and onto homepage
function redirectSubsToFronted(){
	$ourCurrentUser=wp_get_current_user();
if(count($ourCurrentUser->roles)==1 and
         $ourCurrentUser->roles[0]=='subscriber'){
wp_redirect(site_url('/'));
exit;
	}
}
add_action('admin_init','redirectSubsToFronted') ;
//remove admin bar
function noSubsAdminBar(){
	$ourCurrentUser=wp_get_current_user();
if(count($ourCurrentUser->roles)==1 and
         $ourCurrentUser->roles[0]=='subscriber'){
show_admin_bar(false);
	}
}
add_action('wp_loaded','noSubsAdminBar');
//custom login screen
//change kink logo in page login
function ourheaderUrl(){
	return esc_url(site_url('/'));
}
add_filter('login_headerurl','ourheaderUrl');
function ourLoginCSS(){
	wp_enqueue_style('wajeeh_main_styles',get_stylesheet_uri());
	wp_enqueue_style('custom-google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('login_enqueue_scripts','ourLoginCSS');
function ourLoginTitle(){
	return get_bloginfo('name');
}

add_filter('login_headertitle','ourLoginTitle');