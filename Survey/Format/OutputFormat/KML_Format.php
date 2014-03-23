<?php

namespace Survey\Format\OutputFormat;

class KML_Format implements \Survey\Format\OutputFormat\General_Format {

    private $format = 'KML';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type)
    {
        parent::__construct($data, $type);
    }

    public function getData()
    {
        return $this->_type->convertData($this->_data, $this->format);
    }

}