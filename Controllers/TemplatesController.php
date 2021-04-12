<?php 
/**
* Class name: TemplatesController()
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

class TemplatesController extends AppController
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


        $types = get_field('s1-2-selection');
        if ($types) {
            $allfOnd = array(); 

            foreach ($types as $key => $value) {

                $args = array(
                    'post_type'       => array('fonds'),
                    'post_status'     => array('publish'),
                    'posts_per_page'  => -1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy'         => 'types',
                            'field'            => 'id',
                            'terms'            => array( $value),
                            'operator'         => 'IN',
                        )
                    )
                );
                $fond = new Timber\PostQuery($args);
                if ($fond) {
                    $tmp = array(
                        'type' => get_term($value, 'types'),
                        'post' => $fond
                    );
                    $allfOnd[] = $tmp ;
                }
            }
        }


        $args = array(
            'post_type'       => array('post'),
            'post_status'     => array('publish'),
            'posts_per_page'  => 3
        );

        $lastPost = new Timber\PostQuery($args);
        

        $this->render('templates/home.twig', array(
            'post' => new TimberPost,
            'allFond' => $allfOnd,
            'lastPost' => $lastPost
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * cmsAction() method renders <templates/cms> and provide it some datas
    *
    * @return void
    */
    public function cmsAction(){
        $this->render('templates/cms.twig', array(
            'post' => new TimberPost
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * contactAction() method renders <templates/contact> and provide it some datas
    *
    * @return void
    */
    public function contactAction(){
        $this->render('templates/contact.twig', array(
            'post' => new TimberPost
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * SampleAction() method renders <templates/cible> and provide it some datas
    *
    * @return void
    */
    public function cibleAction(){

        $post = new TimberPost; 
        $parent = wp_get_post_parent_id($post);

        if ($parent) {
            $post_parent = new TimberPost($parent);
        }

        $this->render('templates/cible.twig', array(
            'post' => $post,
            'post_parent' => $post_parent,
        ));
    }


     /**
     * Method called by Router::routing()
    *
    * SampleAction() method renders <templates/rse> and provide it some datas
    *
    * @return void
    */
    public function rseAction(){
        $this->render('templates/rse.twig', array(
            'post' => new TimberPost
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * SampleAction() method renders <templates/about> and provide it some datas
    *
    * @return void
    */
    public function aboutAction(){
        $this->render('templates/about.twig', array(
            'post' => new TimberPost
        ));
    }


     

     /**
     * Method called by Router::routing()
    *
    * SampleAction() method renders <templates/metier> and provide it some datas
    *
    * @return void
    */
    public function metierAction(){
        $this->render('templates/metier.twig', array(
            'post' => new TimberPost
        ));
    }


   


}