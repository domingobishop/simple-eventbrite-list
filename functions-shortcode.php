<?php
/**
 * Shortcode
 *
 *
 */

function sebl_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'numberevents' => 6,
		'category' => ''
	), $atts);

	$token = get_option('sebl_token');
	$organiser = get_option('sebl_organiser');
	$number = $a['numberevents'];
	$category = '';

	if ($a['category']) {
		$cat = $a['category'];
		$category = '&categories='.$cat;
	}
	if ($token=='') {
		return '<h2>Eventbrite API token not found</h2>
				<p>Please add token to settings page.
				<a href="https://www.eventbrite.com/developer/v3/api_overview/authentication/#ebapi-getting-a-token">
				For help please see Eventbrite documentation</a>.</p>';
	}

	$events = new Simple_Eventbrite_List;

	return $events->display( $organiser, $category, $token, $number );
}
