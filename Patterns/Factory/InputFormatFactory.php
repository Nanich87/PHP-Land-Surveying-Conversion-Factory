<?php

namespace Patterns\Factory;

class InputFormatFactory {

    private function __construct()
    {
        
    }

    public static function create($inputData, $inputFormat, $outputFormat = null)
    {
        switch ($inputFormat)
        {
            case 'DINI': return new \Survey\Format\InputFormat\DINI_Format($inputData, $outputFormat);
            case 'DPI': return new \Survey\Format\InputFormat\DPI_Format($inputData, $outputFormat);
            case 'CAD': return new \Survey\Format\InputFormat\CAD($inputData, $outputFormat);
            case 'KOR': return new \Survey\Format\InputFormat\KOR_Format($inputData, $outputFormat);
            case 'KPT': return new \Survey\Format\InputFormat\KPT_Format($inputData, $outputFormat);
            default: throw new \Exception('Invalid input format!');
        }
    }

}