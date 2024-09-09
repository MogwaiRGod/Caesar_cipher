<?php
namespace Controllers;

use core\AbstractController as AbstractController;

/**
 * Documentation
 */
class HomeController extends AbstractController{
    /**
     * @method public static void index(): Loads the corresponding html template
     */

    public function index(): void
    {
        $this->render('index');
    } // index

} // HomeController