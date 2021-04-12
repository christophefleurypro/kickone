<?php 
/**
* Class name: PortfolioController()
*
* A controller class is composed of methods suffixed with "Action", and responsibles for the following tasks:
* - Render the correct Twig/Timber template for the current page
* - Do the business logic associated to the current page
* - Provide the datas to the Twig/Timber templates
*
*/

namespace Controllers;

use \TimberPost;
use \Timber\PostQuery;
use \Timber;

class PortfolioController extends AppController
{
    /**
     * __Constructor:
    *
    * Call AppController::__construct to inherit AppController useful methods
    *
    * @return void
    */
    public function __construct(){
        parent::__construct();
    }


    /**
     * Method called by Router::routing()
    *
    * homeAction() method renders <templates/home> and provide it some datas
    *
    * @return void
    */
    public function homeAction(){

        $this->render('portfolio/listing-portfolio.twig', array(
            'post' => new TimberPost,
        ));
    }


 


   


}