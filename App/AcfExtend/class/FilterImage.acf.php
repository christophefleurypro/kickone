<?php

use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\TrueFalse;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\ColorPicker;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\ButtonGroup;
use WordPlate\Acf\Fields\Select;

class ImageFilter extends \WordPlate\Acf\Fields\Group{

  	public static function make(string $label, string $name = null ) :\WordPlate\Acf\Fields\Field
  	{

      	$field = parent::make($label,$name);
      	$field->layout('block');
		$field->wrapper(['class'=>'acf-group-image']);
      	return $field->fields([
      		Image::make('Image', 'image-filter')
      			->returnFormat('array')
      			->required()
    			->previewSize('medium') 
	      		->wrapper(['width' => '25']),
			Group::make('Paramètres','image--params')
				->layout('block') 
			    ->fields([
			    	TrueFalse::make('Filtre', 'add-filter')
						->instructions('Ajouter une couleur à l\'image')
						->wrapper(['width' => '51'])
			    		->stylisedUi()
					    ->defaultValue(false),
			        ColorPicker::make('Couleur du filtre','color-filter')
						->instructions('La couleur aura une opacité de 0.5')
					    ->defaultValue('#323232')
						->wrapper(['width' => '49'])
					    ->conditionalLogic([
					    	ConditionalLogic::if('add-filter')->equals(1)
					    ]),
					ButtonGroup::make('Taille', 'add-taille')
						->instructions('Taille de l\'image en fonction de sa zone')
					    ->choices([
					        'cover' => 'Cover',
					        'contain' => 'Contain',
					    ])
					    ->defaultValue('cover')
					    ->returnFormat('value')
						->wrapper(['width' => '51']),
					Select::make('Position', 'add-position')
						->instructions('Position de l\'image en fonction de sa zone')
					    ->choices([
					        'left-top'	    => 'Aligné à gauche et en haut',
					        'left-center' 	=> 'Aligné à gauche et centré',
					        'left-bottom' 	=> 'Aligné à gauche et en bas',
					        'right-top' 	=> 'Aligné à droite et en haut',
					        'right-center' 	=> 'Aligné à droite et centré',
					        'right-bottom' 	=> 'Aligné à droite et en bas',
					        'center' => 'Centré',
					    ])
					    ->defaultValue('center')
					    ->returnFormat('value') 
						->wrapper(['width' => '49'])
					    ->conditionalLogic([
					    	ConditionalLogic::if('add-taille')->equals('cover')
					    ]),

			    ])
				->wrapper(['width' => '75']),
		]);
	}

}

 ?>
