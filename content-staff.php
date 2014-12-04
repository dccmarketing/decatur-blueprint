<?php
/**
 * @package Decatur Blueprint
 */

$staff = decaturblue_get_staff();

if ( 1 <= $staff->post_count ) {

	foreach ( $staff->posts as $person ) {

		$img = get_thumbnail_url( $person->ID );

		?><a href="<?php echo get_permalink( $person->ID ); ?>"><div class="staff_link" style="background-image:url(<?php echo $img; ?>)"><?php echo $person->post_title; ?></div></a><?php

		//pretty( $person );

	} // foreach

	pretty( $staff );

}