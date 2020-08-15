<?php
//the url is localhost/wordpress/blog
get_header();
pageBanner(array(
'title'=>'Search Result',
'subtitle'=>'You search For &ldquo;'.esc_html(get_search_query(false)).'&rdquo;'
));?>


<div class="container container--narrow page-section">
<?php
if(have_posts()){


while(have_posts()){
the_post();
get_template_part('template-parts/content',get_post_type());

}

echo paginate_links();
}else{
	echo "<h2 class='headline headline--small-plus'> no result</h2>";
}
//get content file searchform.php
get_search_form();

?>

</div>

<?php
get_footer();	

?>