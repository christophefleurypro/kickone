<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\FlexibleContent;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;

register_extended_field_group([
    'title' => "Page d'accueil",
    'fields' => [
    	Relationship::make('Mes projets en avant','--relation')
            ->postTypes(['projet'])
            ->returnFormat('object'), // id or object
        Repeater::make('Listing', '--cadre')
            ->fields([
                Textarea::make('Titre','--titre')
                    ->newLines('br')
            ])
            ->layout('row'), // block, row or table
    ],
    'location' => [
        Location::if('page_template', 'templates/home.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
