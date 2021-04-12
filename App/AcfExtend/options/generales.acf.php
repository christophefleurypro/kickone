<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Radio;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\ConditionalLogic;


register_extended_field_group([
    'title' => 'Gestions générales',
    'fields' => [
    ],
    'location' => [
		Location::if('options_page', 'acf-options-generales'),
    ],
    'style' => 'default'
]);
?>
