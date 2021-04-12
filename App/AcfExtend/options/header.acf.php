<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\Radio;
use WordPlate\Acf\Fields\ButtonGroup;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Message;
use WordPlate\Acf\Fields\Repeater;

// In this example we use the title as the question.
register_extended_field_group([
	'title' => 'Gestion du haut de page',
	'fields' => [
		SimpleBtn::Make('Bouton', 'header_btn')
	],
	'location' => [
			Location::if('options_page', 'acf-options-header'),
	],
	'style' => 'default'
]);


 ?>
