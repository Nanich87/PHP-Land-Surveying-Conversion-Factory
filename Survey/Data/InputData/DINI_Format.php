<?php

namespace Survey\Data\InputData;

class DINI_Format implements \Survey\Data\InputData\InputDataInterface {

    public function convertData($outputData, $outputFormat) {
        $method = 'convertTo' . $outputFormat;
        if (method_exists(__CLASS__, $method)) {
            return $this->$method($outputData);
        } else {
            throw new \Exception(sprintf("%s does not support conversion to %s!", __CLASS__, $outputFormat));
        }
    }

    private function convertToXML($outputData) {
        $outputString = '<LevelingNetwork>';
        $outputString .= '<WeightMode>1</WeightMode>';
        $outputString .= '<Lines>';
        foreach ($outputData as $Line) {
            $outputString .= '<Line>';
            $outputString .= sprintf('<BackBenchmark>%s</BackBenchmark>', $Line['back_benchmark']);
            $outputString .= sprintf('<ForwardBenchmark>%s</ForwardBenchmark>', $Line['forward_benchmark']);
            $outputString .= sprintf('<Elevation>%1.4f</Elevation>', $Line['elevation']);
            $outputString .= sprintf('<Length>%1.2f</Length>', $Line['length']);
            $outputString .= sprintf('<Station>0</Station>');
            $outputString .= '</Line>';
        }
        $outputString .= '</Lines>';
        $outputString .= '</LevelingNetwork>';
        return $outputString;
    }

    private function convertToTXT($outputData) {
        $outputString = '';
        foreach ($outputData as $Line) {
            $outputString .= sprintf("%s %s %1.4f %1.2f 0%s", $Line['back_benchmark'], $Line['forward_benchmark'], $Line['elevation'], $Line['length'], PHP_EOL);
        }
        return $outputString;
    }

    private function convertToJSON($outputData) {
        return json_encode($outputData);
    }

}