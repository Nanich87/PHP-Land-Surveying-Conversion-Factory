<?php

namespace Survey\Format\OutputFormat;

abstract class Base_Format implements \Contracts\ExportableFormat {

    protected $convertibleData = [];
    protected $convertibleFormat = null;

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        $this->convertibleData = $data;
        $this->convertibleFormat = $format;
    }

    public function setData($data) {
        $this->convertibleData = $data;
    }

    public function setFormat(\Contracts\ConvertibleFormat $format) {
        $this->convertibleFormat = $format;
    }

    public function getData() {
        return $this->convertibleFormat->convert($this->convertibleData, $this->format);
    }

}