<?php

namespace Patterns\Factory;

class InputFormatFactory {

    private function __construct() {
        
    }

    public static function create($data, $dataFormat, $outputFormat = null) {
        switch ($dataFormat) {
            case 'DINI': return new \Survey\Format\InputFormat\DINI_Format($data, $outputFormat);
            case 'DPI': return new \Survey\Format\InputFormat\DPI_Format($data, $outputFormat);
            case 'CAD': return new \Survey\Format\InputFormat\CAD($data, $outputFormat);
            case 'KOR': return new \Survey\Format\InputFormat\KOR_Format($data, $outputFormat);
            case 'KPT': return new \Survey\Format\InputFormat\KPT_Format($data, $outputFormat);
            default: throw new \Exception('Invalid input format!');
        }
    }

}