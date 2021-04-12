<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\PostObject;

register_extended_field_group([
    'title' => "Page d'actualité'",
    'fields' => [
    	Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('Nos actualités','s-banner'),
        
    ],
    'location' => [
        Location::if('page_template', 'templates/blog.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
