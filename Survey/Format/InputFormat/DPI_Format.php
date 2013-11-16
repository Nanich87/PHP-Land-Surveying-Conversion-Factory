<?php

namespace Survey\Format\InputFormat;

class DPI_Format extends \Survey\Format\InputFormat\Base_Format {

    private $_inputFile = [];
    private $_outputData = [];
    private $_outputType = null;

    public function __construct($inputFileString, $outputFormat = DEFAULT_OUTPUT_FORMAT) {
        if (strlen($inputFileString) == 0) {
            throw new \Exception('Input file cannot be empty!');
        }
        $this->_inputFile = explode(PHP_EOL, $inputFileString);
        $this->_outputType = new \Survey\Data\LineDataTypeConversion();
        $this->setOutputFormat($outputFormat);
    }

    public function convert() {
        $fileSize = count($this->_inputFile);
        for ($i = 3; $i < $fileSize - 1; $i++) {
            $this->_inputFile[$i] = preg_replace("/\s\s+/", ' ', trim($this->_inputFile[$i]));
            $lineSize = count(explode(' ', $this->_inputFile[$i]));
            switch ($lineSize) {
                case 4:
                    list($backBenchmark) = sscanf($this->_inputFile[$i], 'Stn %s Vi 0.000');
                    break;
                case 6:
                    list($forwardBenchmark, $length, $elevation) = sscanf($this->_inputFile[$i], 'Nt %s D %f h %f');
                    $this->_outputData[] = array(
                        'back_benchmark' => $backBenchmark,
                        'forward_benchmark' => $forwardBenchmark,
                        'elevation' => $elevation,
                        'length' => $length
                    );
                    break;
            }
        }
    }

    public function toArray() {
        return $this->_outputData;
    }

    public function toString() {
        $outputString = $this->getData($this->_outputData, $this->_outputType, $this->оutputFormat);
        return $outputString;
    }

}