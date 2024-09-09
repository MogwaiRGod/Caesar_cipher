<?php
namespace Controllers;

use core\AbstractController as AbstractController;

/**
 * Documentation
 * 
 * @method public void index(): Loads the corresponding html template
 */
class HomeController extends AbstractController{

    /**
     * Load the index html page
     * 
     * @return void
     */
    public function index(): void
    {
        $this->render('index');
    } // index

} // HomeController