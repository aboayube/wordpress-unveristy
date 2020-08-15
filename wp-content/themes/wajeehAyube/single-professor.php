<?php
get_header();
while(have_posts()){
the_post();pageBanner(array(
'title'=>'hello there this is the title',
));
?>

  <div class="container container--narrow page-section">
    
<div class="generic-content">
	<div class="row group">
<div class="one-third">
<?php the_post_thumbnail('professorPortrail');?>
</div>

<div class="two-third">
<?php the_content();?>
</div>
	</div>


</div>
<h2 class="headline--medium">Subject(s)</h2>
<ul>
<?php 
$relatedPrograms=get_field('realated_programs');
if($relatedPrograms){
foreach ($relatedPrograms as $program) {?>
  <li><a href="<?php echo get_the_permalink()?>"><?php echo  get_the_title($program);?></a></li>
  
 <?php
}}
?>
</ul>

    </div>

<?php
 } 
get_footer();?>