<?php

namespace Survey\Data\InputData;

class KOR_Format implements \Survey\Data\InputData\InputDataInterface {

    public function convertData($outputData, $outputFormat) {
        if (method_exists(__CLASS__, $outputFormat)) {
            return $this->$outputFormat($outputData);
        } else {
            throw new \Exception('Invalid output format!');
        }
    }

    private function XML($outputData) {
        $outputString = '<network>';
        $outputString .= '<points>';
        foreach ($outputData as $point) {
            $outputString .= '<point>';
            $outputString .= sprintf('<pointName>%s</pointName>', $point['point_name']);
            $outputString .= sprintf('<pointClass>%s</pointClass>', $point['point_class']);
            $outputString .= sprintf('<positionX>%1.3f</positionX>', $point['x']);
            $outputString .= sprintf('<positionY>%1.3f</positionY>', $point['y']);
            $outputString .= sprintf('<heightClass>%s</heightClass>', $point['level_class']);
            $outputString .= sprintf('<height>%1.3f</height>', $point['height']);
            $outputString .= sprintf('<rmsX>%1.3f</rmsX>', $point['mx']);
            $outputString .= sprintf('<rmsY>%1.3f</rmsY>', $point['my']);
            $outputString .= sprintf('<totalRMS>%1.3f</totalRMS>', $point['ms']);
            $outputString .= sprintf('<rmsH>%1.3f</rmsH>', $point['mh']);
            $outputString .= '</point>';
        }
        $outputString .= '</points>';
        $outputString .= '</network>';
        return $outputString;
    }

    private function TXT($data) {
        $outputString = '';
        foreach ($data as $point) {
            $outputString .= implode(' ', $point) . PHP_EOL;
        }
        return $outputString;
    }

    private function KML($outputData) {
        $outputString = '<?xml version="1.0" encoding="UTF-8"?>';
        $outputString .= '<kml xmlns="http://www.opengis.net/kml/2.2">';
        foreach ($outputData as $point) {
            $outputString .= '<Placemark>';
            $outputString .= sprintf('<name>%s</name>', $point['point_name']);
            $outputString .= sprintf('<description>%s</description>', $point['height']);
            $outputString .= sprintf('<Point><coordinates>%s,%s</coordinates></Point>', $point['x'], $point['y']);
            $outputString .= '</Placemark>';
        }
        $outputString .= '</kml>';
        return $outputString;
    }

}