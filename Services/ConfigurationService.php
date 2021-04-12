<?php
/**
* Class name: ConfigurationService()
*
* This class is allows to parse YAML config files, and then return array-formatted config parameters  
* To manage this, We use the Spyc library
*
*/

namespace Services;

class ConfigurationService
{
    /**
    * ParseYamlFile method is used to parse YAML config files, and then return array-formatted config parameters  
    *
    * @param string  $file  Filename to parse
    *
    * @return array YAML file content 
    */
    public static function parseYamlFile($file)
    {
        $yaml_file = ROOT . '/App/config/'. $file .'.yml';

        return is_file($yaml_file) ? \App\Vendors\Spyc::YAMLLoad($yaml_file) : false;
    }

    /**
    * ParseYamlFile method is used to add ACF Class config files, and then return array-formatted config parameters  
    *
    * @param string  $file  Filename to parse
    *
    * @return array YAML file content 
    */
    public static function parseAcfExtendFile($folder,$file)
    {
        $class_file = ROOT . '/App/AcfExtend/'.$folder.'/'. $file .'.acf.php';
        if (is_file($class_file)) {
            require_once $class_file  ;
        }
    }
}
