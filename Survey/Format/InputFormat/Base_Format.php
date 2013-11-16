<?php

namespace Survey\Format\InputFormat;

class Base_Format {

    const DEFAULT_OUTPUT_FORMAT = 'XML';

    protected $оutputFormat = null;
    private $_supportedOutputFormats = array(
        'XML' => 'eXtensible Markup Language',
        'TXT' => 'Text File',
        'JSON' => 'JavaScript Object Notation'
    );

    public function setOutputFormat($outputFormat = DEFAULT_OUTPUT_FORMAT) {
        if (isset($this->_supportedOutputFormats[$outputFormat])) {
            $this->оutputFormat = $outputFormat;
        } else {
            throw new \Exception('Invalid output format!');
        }
    }

    public static function getSupportedOutputFormats() {
        return $this->_supportedOutputFormats;
    }

    protected function getData($outputData, $outputType, $outputFormat = DEFAULT_OUTPUT_FORMAT) {
        $outputFileString = \Patterns\Factory\OutputFormatFactory::create($outputData, $outputType, $outputFormat);
        return $outputFileString->getData();
    }

}