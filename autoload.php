<?php

spl_autoload_register(function ($class) {
    
    $directories = [
        __DIR__ . '\classes'
    ];
    
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    foreach ($directories as $directory) {
        $file = $directory . DIRECTORY_SEPARATOR . $classPath;
//        echo "Checking: $file<br>";
        if (file_exists($file)) {
//            echo "Loading: $file<br>";
            require_once $file;
            return;
        }
    }
    echo "Class not found: $class<br>";
    
});

// spl_autoload_register(function ($class) {
//     // Define the base directory for the classes
//     $baseDir = __DIR__ . '/../classes/'; // Go up one level to the root, then into classes/

//     // Convert namespace separators to directory separators
//     $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

//     // Construct the full file path
//     $file = $baseDir . $classPath;

//     // Debug: Print the file path being checked
//     echo "Checking: $file<br>";

//     // Check if the file exists
//     if (file_exists($file)) {
//         // Debug: Print the file being loaded
//         echo "Loading: $file<br>";
//         require_once $file;
//         return; // Stop searching once the file is found
//     }

//     // Debug: Print if the class is not found
//     echo "Class not found: $class<br>";
// });