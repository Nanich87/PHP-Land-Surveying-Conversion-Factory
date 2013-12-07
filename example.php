<?php

function __autoload($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    if (file_exists($className . '.php')) {
        require_once($className . '.php');
    }
}

try {
    // път до файла за конвертиране
    $inputFile = './SampleFiles/dini.txt';
    // прочитане на файла като текстов низ
    $inputString = file_get_contents($inputFile);

    // създаване на нов входен файл с формат KOR
    $newFormat = \Patterns\Factory\InputFormatFactory::create($inputString, 'DINI', 'XML');
    // последващо задаване на изходен формат
    $newFormat->setOutputFormat('TXT');
    // конвертиране на входния файл в зададения изходенн формат
    $newFormat->convert();
    // показване на конвертирания файл като символен низ
    echo $newFormat->toString();
} catch (\Exception $e) {
    echo $e->getMessage();
}