<?php

spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/app/Entity/',
        __DIR__ . '/app/Repository/',
        __DIR__ . '/app/Service/',
        __DIR__ . '/config/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>
