<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Url;


register_extended_field_group([
    'title' => 'Liens de vos réseaux sociaux',
    'fields' => [
        Url::make('Facebook','lien_facebook'),
        Url::make('Twitter','lien_twitter'),
        Url::make('Instagram','lien_instagram'),
        Url::make('Linkedin','lien_linkedin'),
        Url::make('Youtube','lien_youtube'),
        Url::make('Malt','lien_malt'),
    ],
    'location' => [
				Location::if('options_page', 'acf-options-reseaux-sociaux'),
    ],
    'style' => 'default'
]);
?>
