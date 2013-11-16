<?php

namespace Survey\Format\OutputFormat;

class TXT_Format implements \Survey\Format\OutputFormat\OutputFormatInterface {

    private $_data = [];
    private $_type = null;
    private $_format = 'TXT';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type) {
        $this->_data = $data;
        $this->_type = $type;
    }

    public function setData($data) {
        $this->_data = $data;
    }

    public function setDataType(\Survey\Data\InputData\InputDataInterface $type) {
        $this->_type = $type;
    }

    public function getData() {
        return $this->_type->convertData($this->_data, $this->_format);
    }

}