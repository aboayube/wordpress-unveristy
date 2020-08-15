<?php
get_header();
while(have_posts()){
the_post();?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title()?></h1>
      <div class="page-banner__intro">
        <p>Learn how the school of your dreams got started.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('/campus')?>"><i class="fa fa-home" aria-hidden="true"></i> Campus</a> <span class="metabox__main">
 <?php the_time('n.j.Y')?> يسكون الحدث في 
      </span></p>
    </div>  
<div class="generic-content"><?php the_content();?></div>
    </div>
    <pre>
       <?php 
$nameLocation=get_field('map_location');
 ?>

<img src="<?php echo $nameLocation['url']?>?>" width="500px" height="500px" style="margin-left:300px">
<?php
$realatedProgram=new WP_Query(array(
'posts_per_page'=>-1,
'post_type'=>'program',
'orderby'=>'title',
'order'=>'ASC',
//to donet get the old event
'meta_query'=>array(
  array(
   'key'=>'relation_campus',
   'compare'=>'LIKE',
   'value'=>'"'.get_the_ID().'"',
 )
),
));

if($realatedProgram->have_posts()){

?>
<hr class="section-break">
<h2 class="headline headline--medium">Programs Avialable this campus</h2>
<?php
echo '
<ul class="professor-cards">';
while($realatedProgram->have_posts()){
$realatedProgram->the_post();?>
<li> <a href="<?php the_permalink()?>"><?php the_title();?>
</a>
  
</li>
<?php
}
echo '
</ul>';     
} 
 } 
get_footer();?>