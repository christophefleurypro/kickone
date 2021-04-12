<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Textarea;



// In this example we use the title as the question.
register_extended_field_group([
		'title' => 'Analytics Google',
		'fields' => [
				Textarea::make('Script Google Tag Manager','scripts_analytics')
		],
		'location' => [
				Location::if('options_page', 'acf-options-analytics'),
		],
		'style' => 'default'

]);

// In this example we use the title as the question.
register_extended_field_group([
		'title' => 'Analytics Cookie',
		'fields' => [
				Textarea::make('Cookie','scripts_cookie'),
		],
		'location' => [
				Location::if('options_page', 'acf-options-cookie'),
		],
		'style' => 'default'

]);


				
