<?php
/**
* Class name: TimberManager()
*
* This class is a Singleton meant to handle Timber/Twig mechanisms
*
*/

namespace Managers;

use \Timber;
use \TimberMenu;
use \Twig_Extension_StringLoader;
use \Services\ConfigurationService;

class TimberManager
{
	/**
    * @var object  Unique instance of TimberManager Class (Singleton)
    */
    private static $instance;

    /**
    * @var array  Array that contains all configurations for TimberManager
    */
    private $configuration = array();


    /**
	* __Constructor:
	*
	* Contructor is private, TimberManager class can only be instanciated through the Load() method
	*
	* @return void
	*/
    private function __construct(){
    	$this->configuration = $this->get_configuration();
    	$this->timber();
    	require_once ROOT . '/App/Vendors/vendor/autoload.php';
    }


	/**
	* Method called by __constructor()
	*
	* TimberManager() class is a singleton.
	*
	* Load() method ensure that only one instance of TimberManager is loaded
	* The instance is then stored in $instance property
	*
	* @return object  TimberManager instance.
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
	* Register() method is the entry point of TimberManager class
	*
	* @return object  TimberManager instance.
	*/
	public static function register(){
		return self::load();
	}


	/**
	* Method called by __constructor():
	*
	* Timber() method runs Timber features
	* 
	* @return void
	*/
	private function timber() {
		Timber::$locations = ROOT . $this->configuration['timber']['views_location'];

		add_filter('timber_context', array($this, 'add_to_context'));
		add_filter('get_twig', array($this, 'add_to_twig'));
	}


	/**
	* Method called by timber():
	*
	* Add_to_context() method is used to provide additionnal datas used in Twig templates.
	*
	* @return $twig 
	*/
	public function add_to_context($context) {
		$mobileDetect = new \App\Vendors\Mobile_Detect();

		$baseContext = $context;
		$menuContext = $context;
		$customContext = array();
		$debugContext = array();

		$navigation = get_nav_menu_locations();

		foreach ($navigation as $key => $value){
			if(has_nav_menu($key)){
				$menuContext['menu'][$key] = new TimberMenu($value);
			}
		}
		
		$customContext['timber']               = $this;
		$customContext['services'] 	           = new \Services\TimberService;
		$customContext['translations']         = require $this->get_translation_configuration();
		$customContext['src']                  = get_template_directory_uri() . '/web/src';
		$customContext['img']                  = get_template_directory_uri() . '/web/src/img';
		$customContext['dist']                 = get_template_directory_uri() . '/web/dist';
		$customContext['options']              = function_exists('get_fields') ? get_fields('options'): null;
		$customContext['is_device']            = $mobileDetect->isMobile() || $mobileDetect->isTablet();
		$customContext['links']                = $this->getLinks();
		$customContext['clear_head_for_yoast'] = $this->handleHeadForYoast();
        $customContext['google_map_api_key']   = $this->handleGoogleMap();
        $customContext['current_language']     = apply_filters( 'wpml_current_language', NULL );
        //$customContext['languages']            = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
		$customContext['blog_page_url']        = get_permalink( get_option( 'page_for_posts' ) );
        $customContext['breadcrumb'] 		   = do_shortcode('[wpseo_breadcrumb]');
		

		if(defined('WP_DEBUG') && WP_DEBUG){
			$debugContext['debug'] 			    = true;
		}

		return array_merge($baseContext, $menuContext, $customContext, $debugContext);
	}
	

	/**
	* Method called by add_to_context():
	*
	* getLinks() method is used to return an array containing links used in the application
	*
	* @return array  $links  Array containing links used in the application
	*/
	public function getLinks() {
		$links = array();

		foreach($this->configuration['timber']['links'] as $key => $value){
			switch ($key) {
				case 'archives':
					foreach ($value as $k => $v) {
						$links[$key][$k] = get_post_type_archive_link($v);
					}
				break;

				case 'pages':
					foreach ($value as $k => $v) {
						$links[$key][$k] = get_page_link($v);
					}
				break;
			}
		}

		return $links;
	}


    /**
	* Method called by add_to_context():
	*
	* handleHeadForYoast() method is used to clear metas if using Yoast
	*
	* @return bool bool wether have to clear head or not
	*/
    private function handleHeadForYoast(){
        $return = false;

        if($this->configuration['wordpress']['clear_head_for_yoast'] === true){
            remove_theme_support( 'title-tag' );
            $return = true;
        }

        return $return;
    }


    private function handleGoogleMap(){
        $return = null;

        if(isset($this->configuration['acf']['google_map_api_key'])){
            $googleMapApiKey = $this->configuration['acf']['google_map_api_key'];
            
            if($googleMapApiKey){
                $return = $googleMapApiKey;
            }
        }

        return $return;
    }


	/**
	* Method called by timber():
	*
	* Add_to_twig() method is used to:
	* - Activate some Twig extensions 
	* - Add our own functions to Twig
	*
	* @return $twig 
	*/
	public function add_to_twig($twig) {
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter(new \Twig_SimpleFilter('cast_to_array', array( $this, 'cast_to_array')));
		$twig->addGlobal('services', new \Services\TimberService);
		return $twig;
	}


	/**
	* Method called by add_to_twig():
	*
	* cast_to_array() method cast an object type to array type
	*
	* @param object  $element  object to cast to array
	*
	* @return array  object cast to array
	*/
	public function cast_to_array($element) {
	    if(is_object($element)){
	    	$element = (array) $element;
	    }

	    return $element;
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
        return array(
            'timber'    => ConfigurationService::parseYamlFile('timber'),
            'wordpress' => ConfigurationService::parseYamlFile('wordpress'),
            'acf'       => ConfigurationService::parseYamlFile('acf')
        );
    }


    /**
	* Method called by __constructor()
	*
	* get_translation_configuration() method allows to:
	* - Parse YAML file "App/config/_translations.php"
	* - It retrieves an array containing all WPML traductions
	*
	* @return array  Array containing all WPML traductions
	*/
    private function get_translation_configuration(){
		return ROOT . '/App/config/_translations.php';
	}
}