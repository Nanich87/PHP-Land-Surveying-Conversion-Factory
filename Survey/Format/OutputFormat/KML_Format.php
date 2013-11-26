<?php

namespace Survey\Format\OutputFormat;

class KML_Format implements \Survey\Format\OutputFormat\OutputFormatInterface {

    private $_data = [];
    private $_type = null;
    private $_format = 'KML';

    public function __construct($data, \Survey\Data\InputData\KOR_Format $type) {
        $this->_data = $data;
        $this->_type = $type;
    }

    public function setData($data) {
        $this->_data = $data;
    }

    public function setDataType(\Survey\Data\InputData\KOR_Format $type) {
        $this->_type = $type;
    }

    public function getData() {
        return $this->_type->convertData($this->_data, $this->_format);
    }

}