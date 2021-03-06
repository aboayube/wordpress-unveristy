<?php
function wajeehRegisterSearch(){
	/*
http://localhost/wordpress/wp-json/wajeeh/v1/search
to can make api route
	*/
register_rest_route('wajeeh/v1','search',array(
   'methods'   =>WP_REST_SERVER::READABLE,
   'callback'  =>'wajeehSearchResult',
));	
}
function wajeehSearchResult($data){
	$mainQuery=new WP_Query(array(
'post_type'=>array('post','page','professor','program','event','campus'),
    's'=>sanitize_text_field($data['term'])
	));

	
	$results=array(
    'generalInfo'=>array(),
    'professors'=>array(),
    'programs'=>array(),
    'events'=>array(),
    'campuses'=>array(),
	);
	while($mainQuery->have_posts()){
$mainQuery->the_post();
if(get_post_type()=='post' or get_post_type()=='page'){
array_push($results['generalInfo'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
'postType'=>get_post_type(),	
'authorName'=>get_the_author(),
));	
}
if(get_post_type()=='professor' ){
array_push($results['professors'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
'image'=>get_the_post_thumbnail_url(0,'professorLandscape'),
));	
}

if(get_post_type()=='program' ){
	$relatedCampus=get_field('relation_campus');
	if($relatedCampus){
         foreach ($relatedCampus as $campus) {
         	array_push($results['campuses'], array(
                 'title'=>get_the_title($campus),
                 'permalink'=>get_the_permalink($campus),
         	));
         }
	}
array_push($results['programs'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
'id'=>get_the_id(),
));	
}

if(get_post_type()=='event' ){
	$eventDate = new DateTime(get_field('event_date', false, false));
$discription='1';
if(has_excerpt()){
	$discription=get_the_excerpt();
}else{
	$discription=wp_trim_words(get_the_content(),18);
}

array_push($results['events'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
'month'=>$eventDate->format('M'),
'day'=>$eventDate->format('d'),
'discription'=>$discription,
));	
}

if(get_post_type()=='campus' ){
array_push($results['campuses'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
));	
}

	}
	//relation ship with programes and prefoser
	if($results['programs']){
	$programsMetaQuery=array( 'relation'=>'OR');
	foreach ($results['programs'] as $item) {
		array_push($programsMetaQuery, array(
       'key'=>'related_programs',
       'compare'=>'LIKE',
       'value'=>'"'.$item['id'].'"',

    ));
	}
	$programRelationshipQuery=new WP_Query(array(
    'post_type'=>array('professor','event'),
    'meta_query'=>$programsMetaQuery,
));

	while($programRelationshipQuery->have_posts()){
		$programRelationshipQuery->the_post();
		

if(get_post_type()=='event' ){
	$eventDate = new DateTime(get_field('event_date', false, false));
$discription='1';
if(has_excerpt()){
	$discription=get_the_excerpt();
}else{
	$discription=wp_trim_words(get_the_content(),18);
}

array_push($results['events'], array(
'title'=>get_the_title(),
'permalink'=>get_the_permalink(),
'month'=>$eventDate->format('M'),
'day'=>$eventDate->format('d'),
'discription'=>$discription,
));	
}
		if(get_post_type()=='professor'){
			array_push($results['professors'], array(
               'title'=>get_the_title(),
               'permalink'=>get_the_permalink(),
     'image'=>get_the_post_thumbnail_url(0,'professorLandscape')
            ));
		}


	}
$results['professors']=array_values( 
	array_unique($results['professors'],SORT_REGULAR));

$results['events']=array_values( 
	array_unique($results['events'],SORT_REGULAR));

	}
	return $results;

}

add_action('rest_api_init','wajeehRegisterSearch');