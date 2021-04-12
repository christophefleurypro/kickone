<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Number;

  register_extended_field_group([
      'title' => 'Projet',
      'fields' => [
          Image::make('Image','projet--Image'),
          Text::make('Fonction','projet--function'),
          Number::make('Année','projet--year'),
          Textarea::make('Description','projet--description')
              ->newLines('br')
              ->rows(4)
              ->characterLimit(300),
          Url::make('lien','projet--url')
      ],
      'location' => [
          Location::if('post_type', 'projet'),
      ],
      'style' => 'default'
  ]);
