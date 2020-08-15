<?php
get_header();pageBanner(array(
'title'=>'Past Events',
'subtitle'=>'the event finsh'
));?>

<div class="container container--narrow page-section">
<?php

        $tody=date('Ymd');
$pastEvent=new WP_Query(array(
  //paged to make url frindle with seo
  'paged'=>get_query_var('paged',1),
'post_type'=>'event',
'meta_key'=>'event_date',
'orderby'=>'meta_value_num',
'order'=>'ASC',
//to donet get the old event
'meta_query'=>array(
  array(
   'key'=>'event_date',
   'compare'=>'<',
   'value'=>$tody,
   'type'=>'numeric',
  ),
),
));

while($pastEvent->have_posts()){
$pastEvent->the_post();

    get_template_part('template-parts/content','event');
}
echo paginate_links(array(
  'total'=>$pastEvent->max_num_pages,

  
));
?>
</div>

<?php
get_footer();	

?>