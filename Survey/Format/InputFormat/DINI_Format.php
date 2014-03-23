<?php

namespace Survey\Format\InputFormat;

class DINI_Format extends \Survey\Format\InputFormat\Base_Format {

    protected $inputFile;
    private $_outputData = [];
    private $_inputDataType;

    public function __construct($inputFileString, $outputFormat)
    {
        parent::__construct($inputFileString, $outputFormat);
        $this->_inputDataType = new \Survey\Data\InputData\DINI_Format();
    }

    public function convert()
    {
        $pattern = '/(\d+\s+Start-Line\s+BF\s+\d+)(.*?)(\d+\s+End-Line\s+\d+)/ism';
        $matches = [];
        if (preg_match_all($pattern, $this->inputFile, $matches))
        {
            foreach ($matches[0] as $line)
            {
                $line = explode(PHP_EOL, $line);
                $size = count($line);
                for ($i = 1; $i < $size - 3; $i++)
                {
                    if ($i % 3 == 0)
                    {
                        $rb = explode(' ', preg_replace("/\s\s+/", ' ', trim($line[$i - 1])));
                        $rf = explode(' ', preg_replace("/\s\s+/", ' ', trim($line[$i])));
                        if ($rb[1] != 'X' && $rf[1] == 'X')
                        {
                            $backBenchmark = $rb[1];
                            $elevation += $rb[5] - $rf[5];
                            $length += $rb[7] + $rf[7];
                            continue;
                        }
                        elseif ($rb[1] == 'X' && $rf[1] == 'X')
                        {
                            $elevation += $rb[5] - $rf[5];
                            $length += $rb[7] + $rf[7];
                            continue;
                        }
                        elseif ($rb[1] == 'X' && $rf[1] != 'X')
                        {
                            $forwardBenchmark = $rf[1];
                            $elevation += $rb[5] - $rf[5];
                            $length += $rb[7] + $rf[7];
                        }
                        else
                        {
                            $backBenchmark = $rb[1];
                            $forwardBenchmark = $rf[1];
                            $elevation = $rb[5] - $rf[5];
                            $length = $rb[7] + $rf[7];
                        }
                        $this->_outputData[] = array(
                            'back_benchmark' => $backBenchmark,
                            'forward_benchmark' => $forwardBenchmark,
                            'elevation' => $elevation,
                            'length' => $length
                        );
                        $elevation = 0;
                        $length = 0;
                    }
                }
            }
        }
    }

    public function toArray()
    {
        return $this->_outputData;
    }

    public function toString()
    {
        $outputString = $this->getData($this->_outputData, $this->_inputDataType, $this->оutputFormat);
        return $outputString;
    }

}