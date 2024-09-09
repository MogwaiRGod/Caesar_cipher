<?php

namespace core;

/**
 * Documentation
 *
 * @method public null|Exception  render(string $fileName): Loads the html file whose name is passt as argument
 */
abstract class AbstractController {

    /**
     * Loads the html file whose name is passt as argument
     * 
     * @param string $fileName
     * @return null|Exception 
     */
    public function render(string $fileName) : null|Exception 
    {
        try {
            // imports the corresponding file
            require(ROOT . 'front/' . $fileName . '.html');

            return null;
        } catch (Exception $e) {
            return $e;

        } // try/catch
    } // render
    
} // AbstractController