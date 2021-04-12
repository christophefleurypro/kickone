<?php

use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Select;
use WordPlate\Acf\Fields\PageLink;
use WordPlate\Acf\Fields\File;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Email;

class SimpleBtn extends \WordPlate\Acf\Fields\Group{

  public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
  {

      $field = parent::make($label,$name);
      return $field->fields([
              Select::make('Type de bouton','lien-type')
                  ->wrapper(['width' => '35'])
                  ->choices([
                      'page'    => 'Page du site',
                      'externe' => 'Lien externe',
                      'mailto'  => 'Adresse e-mail',
                      'phone'   => 'Téléphone',
                      'file'    => 'Fichier',
                      'modal'   => 'Modal'
                  ]),
              PageLink::make('Lien interne', 'lien-interne')
                ->wrapper(['width' => '35'])
                ->conditionalLogic([
                    ConditionalLogic::if('lien-type')->equals('page')
                ]),
              Url::make('Lien externe', 'lien-externe')
                  ->wrapper(['width' => '35'])
                  ->conditionalLogic([
                      ConditionalLogic::if('lien-type')->equals('externe')
                  ]),
              Email::make('E-mail', 'mail')
                  ->wrapper(['width' => '35'])
                  ->conditionalLogic([
                      ConditionalLogic::if('lien-type')->equals('mailto')
                  ]),
              Text::make('Numéro de téléphone', 'phone')
                  ->wrapper(['width' => '35'])
                  ->conditionalLogic([
                      ConditionalLogic::if('lien-type')->equals('phone')
                  ]),
              File::make('Fichier', 'file-interne')
                  ->wrapper(['width' => '35'])
                  ->conditionalLogic([
                      ConditionalLogic::if('lien-type')->equals('file')
                  ]),
              Text::make('Texte du bouton', 'texte')
                  ->wrapper(['width' => '30']),
          ]);
    }
}

 ?>
