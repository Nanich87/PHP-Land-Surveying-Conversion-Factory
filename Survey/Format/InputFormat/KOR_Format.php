<?php

namespace Survey\Format\InputFormat;

class KOR_Format extends \Survey\Format\InputFormat\Base_Format {

    private $_inputFile = [];
    private $_outputData = [];
    private $_outputType = null;

    public function __construct($inputFileString, $outputFormat = DEFAULT_OUTPUT_FORMAT) {
        if (strlen($inputFileString) == 0) {
            throw new \Exception('Input file cannot be empty!');
        }
        $this->_inputFile = explode(PHP_EOL, $inputFileString);
        $this->_outputType = new \Survey\Data\InputData\KOR_Format();
        $this->setOutputFormat($outputFormat);
    }

    public function convert() {
        $fileSize = count($this->_inputFile);
        for ($i = 3; $i < $fileSize - 1; $i++) {
            $this->_inputFile[$i] = preg_replace("/\s\s+/", ' ', trim($this->_inputFile[$i]));
            $lineSize = count(explode(' ', $this->_inputFile[$i]));
            switch ($lineSize) {
                case 10:
                    list($pointName, $pointClass, $x, $y, $levelClass, $height, $mx, $my, $ms, $mh) = sscanf($this->_inputFile[$i], '%s %d %f %f %d %f %f %f %f %f');
                    $this->_outputData[] = array(
                        'point_name' => $pointName,
                        'point_class' => $pointClass,
                        'x' => $x,
                        'y' => $y,
                        'level_class' => $levelClass,
                        'height' => $height,
                        'mx' => $mx,
                        'my' => $my,
                        'ms' => $ms,
                        'mh' => $mh
                    );
                    break;
            }
        }
    }

    public function toArray() {
        return $this->_outputData;
    }

    public function toString() {
        $outputFileString = $this->getData($this->_outputData, $this->_outputType, $this->оutputFormat);
        return $outputFileString;
    }

}