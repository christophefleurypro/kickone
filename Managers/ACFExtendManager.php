<?php
/**
* Class name: ExtendACFManager()
*
* This class is a Singleton meant to handle all ACF features
*
*/

namespace Managers;

use \Services\ConfigurationService;
use \WordPlate\Acf;
use \WordPlate\Acf\Location;
use \WordPlate\Acf\Fields\Wysiwyg;
use \WordPlate\Acf\Fields\Tab;
use \WordPlate\Acf\Fields\Text;


class ACFExtendManager
{
	/**
    * @var object  Unique instance of ACFManager Class (Singleton)
    */
    private static $instance;

    /**
    * @var array  Array that contains all configurations for ACFManager
    */
    private $configuration = array();


    /**
	* __Constructor:
	*
	* Contructor is private, ACFManager class can only be instanciated through the Load() method
	*
	* @return void
	*/
    private function __construct(){

    	$this->configuration = $this->get_configuration();

    	if (!function_exists('register_extended_field_group')) {
    		return ;
    	}

    	$this->acf();
    }



	/**
	* Method called by __constructor()
	*
	* ACFManager() class is a singleton.
	*
	* Load() method ensure that only one instance of ACFManager is loaded
	* The instance is then stored in $instance property
	*
	* @return object  ACFManager instance.
	*/
	private static function load(){
		if (!self::$instance instanceof self) {
            self::$instance = new self;
        }

        return self::$instance;
	}


	/**
	* Method called from AppKernel()
	*
	* Register() method is the entry point of ACFManager class
	*
	* @return object  ACFManager instance.
	*/
	public static function register(){
		return self::load();
	}


	/**
	* Method called by the __constructor():
	*
	* acf() method is used to manage ACF features
	*
	* @return void
	*/
	private function acf(){


		if(isset($this->configuration['class'])){
			foreach ($this->configuration['class'] as $key => $value) {
				ConfigurationService::parseAcfExtendFile('class', $value );
			}
		}

		if(isset($this->configuration['options'])){
			foreach ($this->configuration['options'] as $key => $value) {
				ConfigurationService::parseAcfExtendFile('options', $value );
			}
		}

		if(isset($this->configuration['sections'])){
			foreach ($this->configuration['sections'] as $key => $value) {
				ConfigurationService::parseAcfExtendFile('sections', $value );
			}
		}


		if(isset($this->configuration['cpt'])){
			foreach ($this->configuration['cpt'] as $key => $value) {
				ConfigurationService::parseAcfExtendFile('cpt', $value );
			}
		}

		if(isset($this->configuration['templates'])){
			foreach ($this->configuration['templates'] as $key => $value) {
				ConfigurationService::parseAcfExtendFile('templates', $value );
			}
		}

	
	}





	/**
	* Method called by the __constructor():
	*
	* acf() method is used to manage ACF options
	*
	* @return void
	*/
	private function acf_options(){
		
		
	}


	/**
	* Method called by __constructor()
	*
	* get_configuration() method allows to parse YAML files which contain configurations for this Manager
	* The retrieved array is then stored in $this->configuration property
	*
	* @return array  Array containaing configurations for this Manager
	*/
    private function get_configuration(){
        return ConfigurationService::parseYamlFile('acf-extended');
    }
}