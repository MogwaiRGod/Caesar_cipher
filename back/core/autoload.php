<?php
namespace core;

spl_autoload_register(function(string $class) : void
{
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
    }

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
            return;
        } else {
            echo "Not found: $source\n"; // Debugging line
        }
    } 
});