<?php

namespace Survey\Data\Convert;

class CSV_Format implements \Contracts\ConvertibleFormat {

    public function convert($data, $format) {
        $method = 'convertTo' . $format;
        if (!method_exists(__CLASS__, $method)) {
            throw new \Exception(sprintf("%s does not support conversion to %s!", __CLASS__, $format));
        }

        return $this->$method($data);
    }

    private function convertToGPX($data) {
        $outputString = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>\r\n';
        $outputString .= '<gpx xmlns="http://www.topografix.com/GPX/1/1" creator="MapSource 6.13.7" version="1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.garmin.com/xmlschemas/GpxExtensions/v3 http://www.garmin.com/xmlschemas/GpxExtensions/v3/GpxExtensionsv3.xsd http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd">\r\n';
        $outputString .= '<metadata>\r\n';
        $outputString .= ' <link href="http://www.garmin.com">\r\n';
        $outputString .= '  <text>Garmin International</text>\r\n';
        $outputString .= ' </link>\r\n';
        $outputString .= ' <bounds maxlat="0" maxlon="0" minlat="0" minlon="0" />\r\n';
        $outputString .= '</metadata>\r\n';

        foreach ($data as $point) {
            $outputString .= '<wpt lat="' . $point['latitude'] . '" lon="' . $point['longitude'] . '">\r\n';
            $outputString .= ' <name>' . $point['point'] . '</name>\r\n';
            $outputString .= ' <sym>Waypoint</sym>\r\n';
            $outputString .= ' <extensions>\r\n';
            $outputString .= '  <gpxx:WaypointExtension xmlns:gpxx="http://www.garmin.com/xmlschemas/GpxExtensions/v3">\r\n';
            $outputString .= '   <gpxx:DisplayMode>SymbolAndName</gpxx:DisplayMode>\r\n';
            $outputString .= '   <gpxx:Categories>\r\n';
            $outputString .= '    <gpxx:Category>Category 1</gpxx:Category>\r\n';
            $outputString .= '   </gpxx:Categories>\r\n';
            $outputString .= '  </gpxx:WaypointExtension>\r\n';
            $outputString .= ' </extensions>\r\n';
            $outputString .= '</wpt>\r\n';
        }

        $outputString .= '</gpx>\r\n';

        return $outputString;
    }

    private function convertToXML($data) {
        $outputString = '<Network>';
        $outputString .= '<Points>';

        foreach ($data as $point) {
            $outputString .= '<Point>';
            $outputString .= sprintf('<Number>%s</Number>', $point['point']);
            $outputString .= sprintf('<Latitude>%1.12f</Latitude>', $point['latitude']);
            $outputString .= sprintf('<Longitude>%1.12f</Longitude>', $point['longitude']);
            $outputString .= '</Point>';
        }

        $outputString .= '</Points>';
        $outputString .= '</Network>';

        return $outputString;
    }

    private function convertToTXT($data) {
        $outputString = '';

        foreach ($data as $point) {
            $outputString .= implode(' ', $point) . PHP_EOL;
        }

        return $outputString;
    }

    private function convertToKML($data) {
        $outputString = '<?xml version="1.0" encoding="UTF-8"?>';
        $outputString .= '<kml xmlns="http://www.opengis.net/kml/2.2">';

        foreach ($data as $point) {
            $outputString .= '<Placemark>';
            $outputString .= sprintf('<name>%s</name>', $point['point']);
            $outputString .= sprintf('<description>%s</description>', '');
            $outputString .= sprintf('<Point><coordinates>%s,%s</coordinates></Point>', $point['latitude'], $point['longitude']);
            $outputString .= '</Placemark>';
        }

        $outputString .= '</kml>';

        return $outputString;
    }

    private function convertToJSON($data) {
        return json_encode($data);
    }

}