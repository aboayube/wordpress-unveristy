<?php
//the url is localhost/wordpress/blog
get_header();
	pageBanner(array(
	'title'=>'Welcome to our blog',
	'subtitle'=>'Learn how the school of your dreams got started'
	));?>


<div class="container container--narrow page-section">
<?php
while(have_posts()){
the_post();?>
<div class="post-item">
<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
<div class="metabox">
<p>create by:<?php the_author_posts_link()?> in :<?php the_time('n.j.Y')?> in <?php echo
get_the_category_list(', ')?></p>


</div>
<div class="generic-content">
	<?php the_excerpt();?>
	<p><a   class="btn btn--blue" href="<?php the_permalink()?>">continue reading</a></p>
	</div>
</div>
<?php
}
echo paginate_links();
?>

</div>

<?php
get_footer();	

?>