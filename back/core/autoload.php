<?php
namespace core;

/**
 * spl_autoload_register() creates a series of functions that will be automatically called if the demanded class/interface isn't loaded yet
 * 
 * @param string $class The name of the unloaded demanded class
 * @return null|Exception 
 */
spl_autoload_register(function(string $class) : null|Exception
{
    try {
        // if the class needed is required as a namespace
        if (str_contains($class, '\\')) {
            $class = str_replace('\\', '/', $class);
            $sources = array(
                "back/$class.php",
            );
        } else {
            $sources = array(
                "back/Controllers/$class.php",
                "back/Classes/$class.php",
                "back/core/$class.php",
            );
        } // endif
    
        // attempts to load the file
        foreach ($sources as $source) {
            if (file_exists($source)) {
                require_once $source;
            } else {
                echo "Not found: $source\n"; // Debugging line
            }
    
            return null;
        } // foreach
    } catch (Exception $e) {
        return $e;
    } // try/catch
}); // spl_autoload_register