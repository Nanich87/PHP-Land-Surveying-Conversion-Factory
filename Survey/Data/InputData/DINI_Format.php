<?php

namespace Survey\Data\InputData;

class DINI_Format implements \Survey\Data\InputData\InputDataInterface {

    public function convertData($outputData, $outputFormat) {
        if (method_exists(__CLASS__, $outputFormat)) {
            return $this->$outputFormat($outputData);
        } else {
            throw new \Exception('Invalid output format!');
        }
    }

    private function XML($data) {
        $outputString = '<levelingNetwork>';
        $outputString .= '<weightMode>1</weightMode>';
        $outputString .= '<lines>';
        foreach ($data as $line) {
            $outputString .= '<line>';
            $outputString .= sprintf('<backBenchmark>%s</backBenchmark>', $line['back_benchmark']);
            $outputString .= sprintf('<forwardBenchmark>%s</forwardBenchmark>', $line['forward_benchmark']);
            $outputString .= sprintf('<elevation>%1.4f</elevation>', $line['elevation']);
            $outputString .= sprintf('<length>%1.2f</length>', $line['length']);
            $outputString .= sprintf('<station>0</station>');
            $outputString .= '</line>';
        }
        $outputString .= '</lines>';
        $outputString .= '</levelingNetwork>';
        return $outputString;
    }

    private function TXT($data) {
        $outputString = '';
        foreach ($data as $line) {
            $outputString .= sprintf("%s %s %1.4f %1.2f 0%s", $line['back_benchmark'], $line['forward_benchmark'], $line['elevation'], $line['length'], PHP_EOL);
        }
        return $outputString;
    }

}