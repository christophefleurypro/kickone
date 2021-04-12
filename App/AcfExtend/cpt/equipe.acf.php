<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Url;


  register_extended_field_group([
      'title' => 'Equipe',
      'fields' => [
          Image::make('Image de profil','team--Image'),
          Text::make('Fonction','team--function'),
          Text::make('Déscription','team--description'),
          Text::make('Téléphone','team--phone'),
          Url::make('Facebook','team--fb'),
          Url::make('Linkedin','team--lk')
      ],
      'location' => [
          Location::if('post_type', 'equipe'),
      ],
      'style' => 'default'
  ]);
