<?php

/*
Plugin Name: DM Featured User
Plugin URI: http://ogcsa.org/
Description: Used by Millions to make WordPress better and pollinate flowers.
Author: Bradford Knowlton
Version: 1.9.1
Author URI: http://bradknowlton.com/

GitHub Plugin URI: https://github.com/DesignMissoula/DM-featured-user
GitHub Branch: master

*/

// [bartag foo="foo-value"]
function featured_func( $atts ) {
    $a = shortcode_atts( array(
        'user' => '-1',
    ), $atts );


$args = array( 
						'orderby' => 'meta_value', 
						'meta_key' => 'last_name',
						'role' => 'member',
						'number' => '999',
						'fields' => 'all_with_meta',
						'include' => array( $a['user'] ),
						
						 );
		$blogusers = get_users($args); //subscriber		


 foreach ($blogusers as $user) {
    	$html .= '<div class="entry clearfix">';
    	$html .= '<h2>'.$user->display_name.'</h2>';
    	// get_avatar( $id_or_email, $size, $default, $alt );
    	$html .= '<div class="gravatar alignleft">' . get_avatar( $user->ID, 128, null, $user->display_name ) . '</div>';
        $html .= '<div class="entry-details">';
       //  $html .= '' . $user->last_name . '<br/>';
       // $html .= '' . $user->user_email . '</div>';
  
       $html .= '<span>Member Class:</span> '.str_replace('.','',$user->member_class).'<br/>';
       $html .= '<span>Course/Company:</span> '.$user->course_company.'<br/>';
       
       $html .= '<span>Preferred Address:</span> '.str_replace('*','',$user->primary_address_1).(($user->primary_address_2)?' '.$user->primary_address_2:'').' '.$user->primary_city.', '.$user->primary_state.' '.$user->primary_zip.'<br/>';
  
       $html .= '<span>Position:</span> '.$user->position_title.'<br/>';
       $html .= '<span>Preferred work number #1 and #2:</span> <a href="tel:'.$user->work_tele_1.'">'.format_phone($user->work_tele_1).' </a> <a href="tel:'.$user->work_tele_2.'">'.format_phone($user->work_tele_2).'</a><br/>';
       $html .= '<span>Cell Phone:</span> <a href="tel:'.$user->cell_phone.'">'.format_phone($user->cell_phone).'</a><br/>';
       $html .= '<span>Fax Number:</span> <a href="tel:'.$user->fax_number.'">'.format_phone($user->fax_number).'</a><br/>';
       $html .= '<span>Email Address:</span> <a href="mailto:'.$user->user_email.'">'.$user->user_email.'</a><br/>';
       $html .= '<span>GCSAA Member:</span> '.(("" != $user->gcsaa_member)?'yes':'no').'<br/>';
       $html .= '<span>Pesticide License:</span> '.$user->pesticide_license.'<br/>';
       $html .= '<span>Services Offered:</span> '.$user->services_offered.'<br/>';
       
  
       $html .= '</div><!-- end details -->';
        $html .= '</div><!-- end entry -->';
    }



    return $html;
}
add_shortcode( 'featured', 'featured_func' );