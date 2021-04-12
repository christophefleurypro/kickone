<?php 
/**
* Class name: ProjectsController()
*
* A controller class is composed of methods suffixed with "Action", and responsibles for the following tasks:
* - Render the correct Twig/Timber template for the current page
* - Do the business logic associated to the current page
* - Provide the datas to the Twig/Timber templates
*
*/

namespace Controllers;

use \Timber;
use \Timber\PostQuery;
use \TimberPost;

class FondsController extends AppController
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
    * SampleAction() method renders <templates/listing> and provide it some datas
    *
    * @return void
    */
    public function listingAction(){
        $this->render('fonds/listing.twig', array(
            'post' => new TimberPost
        ));
    }



	/**
	 * Method called by Router::routing()
	*
	* SingleAction() method renders <fonds/single.twig> and provide it some datas
	*
	* @return void
	*/
	public function singleAction(){



		$performances = array(
			array(
				'label' => '1M',
				'data' => '+6,73%'
			),
			array(
				'label' => '3M',
				'data' => '+3,73%'
			),
			array(
				'label' => '1Y',
				'data' => '+0,73%'
			),
			array(
				'label' => '3Y',
				'data' => '+6,73%'
			),
			array(
				'label' => '5Y',
				'data' => '+7,73%'
			),
			array(
				'label' => 'YTD',
				'data' => '+51,73%'
			),
			array(
				'label' => 'MAX',
				'data' => '+65,73%'
			)
		);



		$this->render('fonds/single.twig', array(
			'performances' => $performances,
			'post' => new TimberPost()
		));
	}


}