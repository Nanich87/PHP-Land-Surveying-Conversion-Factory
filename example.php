<?php

function __autoload($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    if (file_exists($className . '.php')) {
        require_once($className . '.php');
    }
}

try {
    $inputFile = './InputFolder/kor.txt';
    $inputString = file_get_contents($inputFile);

    $newFormat = \Patterns\Factory\InputFormatFactory::create($inputString, 'KOR', 'XML');
    $newFormat->setOutputFormat('XML');
    $newFormat->convert();

    echo $newFormat->toString();
} catch (\Exception $e) {
    echo $e->getMessage();
}