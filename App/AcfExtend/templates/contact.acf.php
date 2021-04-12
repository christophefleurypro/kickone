<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\PostObject;

register_extended_field_group([
    'title' => "Page de contact",
    'fields' => [
    	Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('Nous contacter','s-banner'),
        Tab::make("Nous trouver"),
        Text::make('Titre','sc-1-title')
            ->defaultValue('Nous trouver.'),
        Repeater::make('Nous trouver','sc-1-list')
            ->instructions('Ajouter une localisation.')
            ->fields([
                Text::make('Nom du lieu','--name'),
                Text::make('Téléphone','--phone'),
                Textarea::make('Adresse','--adress')
                    ->newLines('br')
            ])
            ->collapsed('name')
            ->buttonLabel('Ajouter un block')
            ->layout('row'), // block, row or table
        Tab::make("Contenu"),
        Text::make('Titre','sc-2-title')
            ->defaultValue('Lorem ipsum dolor.'),
        Textarea::make('Texte','sc-2-text')
            ->defaultValue('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis lectus eget arcu commodo ultricies. Morbi ac feugiat dolor, sit amet gravida enim.')
            ->newLines('br'),
        Tab::make("Formulaire"),
        PostObject::make('Contacts','sc-3-form')
            ->instructions('Add the contacts.')
            ->postTypes(['wpcf7_contact_form'])
            ->returnFormat('id'), // id or object
    ],
    'location' => [
        Location::if('page_template', 'templates/contact.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
