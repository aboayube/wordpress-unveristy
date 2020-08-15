  <?php
get_header();
while(have_posts()){
the_post();

pageBanner();?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program')?>"><i class="fa fa-home" aria-hidden="true"></i>All Program</a> <span class="metabox__main"><?php the_title()?>
      </span></p>
    </div>  
<div class="generic-content"><?php the_field('main_body_content');?></div>
      <?php

        $tody=date('Ymd');
$realatedProfessor=new WP_Query(array(
'posts_per_page'=>-1,
'post_type'=>'professor',
'orderby'=>'title',
'order'=>'ASC',
//to donet get the old event
'meta_query'=>array(
  array(
   'key'=>'realated_programs',
   'compare'=>'LIKE',
   'value'=>'"'.get_the_ID().'"',
 )
),
));
if($realatedProfessor->have_posts()){

?>
<hr class="section-break">
<h2 class="headline headline--medium"> <?php echo get_the_title()?>  Professors</h2>
<?php
echo '
<ul class="professor-cards">';
while($realatedProfessor->have_posts()){
$realatedProfessor->the_post();?>
<li class="professor-card__list_item" style="list-style: none;"> <a href="<?php the_permalink()?>" class="professor-card">
  <img src="<?php the_post_thumbnail_url()?>" class="professor-card__image">
<span class="professor-card__name"><?php the_title()?></span>
</a>
  
</li>
<?php
}
echo '
</ul>';     
} 
wp_reset_postdata();
        $tody=date('Ymd');
$homepageEvents=new WP_Query(array(
'posts_per_page'=>-1,
'post_type'=>'event',
'meta_key'=>'event_date',
'orderby'=>'meta_value_num',
'order'=>'ASC',
//to donet get the old event
'meta_query'=>array(
  array(
   'key'=>'event_date',
   'compare'=>'>=',
   'value'=>$tody,
   'type'=>'numeric',
  ),
  array(
   'key'=>'realated_programs',
   'compare'=>'LIKE',
   'value'=>'"'.get_the_ID().'"',
 )
),
));
if($homepageEvents->have_posts()){

?>
<hr class="section-break">
<h2 class="headline headline--medium">Upcoming <?php get_the_title()?>  Events</h2>
<?php
while($homepageEvents->have_posts()){
$homepageEvents->the_post();

    get_template_part('template-parts/content-event');

}} 
wp_reset_postdata();
$realtedCampus=get_field('relation_campus');
      if($realtedCampus){
        echo '
<hr class="section-break">
        <h2>'.get_the_title(). ' is avilable at these campus</h2>
<ul class="min-list link-list">
        ';
        foreach ($realtedCampus as $campus) {?>
<li><a href="<?php echo get_the_permalink($campus)?>">
  <?php echo get_the_title($campus)?>
</a></li>

          <?php
echo "<ul>";
        }
      }  


        ?>


    </div>

<?php
 }
get_footer();?>