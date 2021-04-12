<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Link;
use WordPlate\Acf\ConditionalLogic;


register_extended_field_group([
    'title' => 'Gestion du bas de page',
    'fields' => [
    	Repeater::make('List de page', 'footer_list_cgu')
            ->fields([
                Link::make('Lien','lien')
            ])
            ->layout('row'), // block, row or table
    ],
    'location' => [
			Location::if('options_page', 'acf-options-footer'),
    ],
    'style' => 'default'
]);
?>
