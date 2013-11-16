<?php

namespace Patterns\Factory;

class OutputFormatFactory {

    private function __construct() {
        
    }

    public static function create($outputData, $outputType, $outputFormat) {
        switch ($outputFormat) {
            case 'XML': return new \Survey\Format\OutputFormat\XML_Format($outputData, $outputType);
            case 'TXT': return new \Survey\Format\OutputFormat\TXT_Format($outputData, $outputType);
            case 'JSON': return new \Survey\Format\OutputFormat\JSON_Format($outputData, $outputType);
            default: throw new \Exception('Invalid output format!');
        }
    }

}