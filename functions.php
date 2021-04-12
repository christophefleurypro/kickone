<?php
/**
*
* Theme name: Kickone
*
* Description: Kickone is a framework which brings a real MVC approach in wordpress development.
*
* @version 1.0.1
*
*/

/*
* Errors handling
*/
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);

/*
* Load helpers functions (nothing executed here)
*/
require 'App/config/_constants.php';

/**
* Load autoloader
*/
require_once 'App/Autoloader.php';

/**
* Register Autoloader
*/
\App\Autoloader::register();

/*
* Check if Timber is activated to proceed
*/
Services\NotificationsService::TimberControl(class_exists('Timber'));

/*
* Run Starer theme mechanisms if/after Timber is loaded
*/
class_exists('Timber') && \App\AppKernel::registerManagers();
