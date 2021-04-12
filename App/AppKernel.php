<?php
/**
* Class name: AppKernel()
*
* This class is a Singleton meant to trigger all Yagami's features
*
*/

namespace App;

class AppKernel
{
	/**
	* Method called in functions.php()
	*
	* registerManagers() method register all Managers that makes Yagami works
	*
	* @return object  AppKernel instance.
	*/
	public static function registerManagers(){
		\Managers\ACFManager::register();
		\Managers\AjaxManager::register();
		\Managers\TimberManager::register();
		\Managers\WordpressManager::register();
		\Managers\RoutingManager::register();
		\Managers\ACFExtendManager::register();
	}
}
