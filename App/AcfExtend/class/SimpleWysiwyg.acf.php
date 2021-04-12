<?php

class SimpleWysiwyg extends \WordPlate\Acf\Fields\Wysiwyg{

  public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
  {

      $field = parent::make($label,$name);
      return $field->mediaUpload(false)
          ->toolbar('simple');
    }
}

 ?>
