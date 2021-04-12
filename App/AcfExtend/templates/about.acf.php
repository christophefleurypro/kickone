<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\FlexibleContent;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\ButtonGroup;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;

register_extended_field_group([
	'title' => 'About',
	'fields' => [
		Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('A propos','s-banner'),
		Tab::make("Content"),
		FlexibleContent::make('Contenu', 's0-content')
			->buttonLabel('Ajouter une nouvelle section')
			->layouts([
				SectionIcone::make('Icone','group-icone'),
				SectionColonne::make('Colonne', 'goup-colone')
			]),
		Tab::make("Page suivante"),
		SectionNext::make('Page suivante','groupe-next'),
	],
	'location' => [
		Location::if('page_template','templates/about.php')
	],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
