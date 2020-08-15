<?php
get_header();
pageBanner(array(
'title'=>'All Event',
'subtitle'=>'see what is going on in the world'
));
?>

<div class="container container--narrow page-section">
<?php


while(have_posts()){
the_post();

    get_template_part('template-parts/content','event');

}
echo paginate_links();
?>
</div>
<p>Looking for a recap of <a href="<?php echo site_url('/past-event')?>">past events</a></p>
<?php
get_footer();	

?>