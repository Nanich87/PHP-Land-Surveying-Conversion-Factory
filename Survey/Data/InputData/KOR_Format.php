<?php

namespace Survey\Data\InputData;

class KOR_Format implements \Survey\Data\InputData\InputDataInterface {

    public function convertData($outputData, $outputFormat) {
        $method = 'convertTo' . $outputFormat;
        if (method_exists(__CLASS__, $method)) {
            return $this->$method($outputData);
        } else {
            throw new \Exception(sprintf("%s does not support conversion to %s!", __CLASS__, $outputFormat));
        }
    }

    private function convertToXML($outputData) {
        $outputString = '<Network>';
        $outputString .= '<Points>';
        foreach ($outputData as $point) {
            $outputString .= '<Point>';
            $outputString .= sprintf('<Number>%s</Number>', $point['point_name']);
            $outputString .= sprintf('<HClass>%s</HClass>', $point['point_class']);
            $outputString .= sprintf('<PositionX>%1.3f</PositionX>', $point['x']);
            $outputString .= sprintf('<PositionY>%1.3f</PositionY>', $point['y']);
            $outputString .= sprintf('<VClass>%s</VClass>', $point['level_class']);
            $outputString .= sprintf('<Height>%1.3f</Height>', $point['height']);
            $outputString .= sprintf('<Mx>%1.3f</Mx>', $point['mx']);
            $outputString .= sprintf('<My>%1.3f</My>', $point['my']);
            $outputString .= sprintf('<Ms>%1.3f</Ms>', $point['ms']);
            $outputString .= sprintf('<Mh>%1.3f</Mh>', $point['mh']);
            $outputString .= '</Point>';
        }
        $outputString .= '</Points>';
        $outputString .= '</Network>';
        return $outputString;
    }

    private function convertToTXT($outputData) {
        $outputString = '';
        foreach ($outputData as $point) {
            $outputString .= implode(' ', $point) . PHP_EOL;
        }
        return $outputString;
    }

    private function convertToKML($outputData) {
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

    private function convertToJSON($outputData) {
        return json_encode($outputData);
    }

}