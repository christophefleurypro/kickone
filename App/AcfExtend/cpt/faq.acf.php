<?php
  use WordPlate\Acf\Fields\Wysiwyg;
  use WordPlate\Acf\Location;


  register_extended_field_group([
      'title' => 'FAQ',
      'fields' => [
          Wysiwyg::make('Réponse','faq-reponse')
              ->instructions('Ajouter une réponseà la question.')
              ->mediaUpload(false)
              ->toolbar('faq')
              ->tabs('visual')
              ->required(),
      ],
      'location' => [
          Location::if('post_type', 'faq'),
      ],
      'style' => 'default'
  ]);
