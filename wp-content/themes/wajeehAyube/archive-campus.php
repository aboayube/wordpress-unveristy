<?php
get_header();
pageBanner(array(
'title'=>'Our Campus',
'subtitle'=>'we have several conveniently'
));?>

<div class="container container--narrow page-section">
	<ul class="link-list min-list">
<?php


while(have_posts()){
the_post();?>
<li><a href="<?php the_permalink()?>"><?php the_title();

?></a>
<?php
$nameLocation=get_field('map_location');
?>
<img src="<?php echo $nameLocation['url']?>?>" width="100px" height="200px">
</li>
<?php
}
?>
</div>
<?php
get_footer();	

?>