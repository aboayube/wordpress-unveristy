<?php

function wajeeh_post_type(){
	

//add program post Type
  register_post_type('program',array(
    'supports'=>array('title'),
    'rewrite'=>array(
       'slug'=>'programs',
     ),
        'has_archive'=>true,
          'public'=>true,
           'labels'=>array(
             'name'=>'Programs',
             'add_new_item'=>'Add New Program',
             'edit_item'=>'Edit Program',
             'all_items'=>'All Programs',
             'Singular_name'=>'Program'
           ) ,
           'menu_icon'=>'dashicons-awards',         
  
  ));
  
//add Professors  post Type
  register_post_type('professor',array(
    'show_in_rest'=>true,
    'supports'=>array('title','editor','thumbnail'),
          'public'=>true,
           'labels'=>array(
             'name'=>'Professors',
             'add_new_item'=>'Add New Professor',
             'edit_item'=>'Edit Professor',
             'all_items'=>'All Professor',
             'Singular_name'=>'Professor'
           ) ,
           'menu_icon'=>'dashicons-welcome-learn-more',         
  
  ));    



//Note  post Type
  register_post_type('note',array(
    'show_in_rest'=>true,
    'supports'=>array('title','editor'),
          'public'=>false,
          'show_ui'=>true,
           'labels'=>array(
             'name'=>'Notes',
             'add_new_item'=>'Add New Note',
             'edit_item'=>'Edit Note',
             'all_items'=>'All Notes',
             'Singular_name'=>'Note'
           ) ,
           'menu_icon'=>'dashicons-welcome-write-blog',         
  
  ));    

}
//create new menu
add_action('init','wajeeh_post_type');


