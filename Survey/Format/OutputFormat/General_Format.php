<?php

namespace Survey\Format\OutputFormat;

abstract class General_Format implements \Survey\Format\OutputFormat\OutputFormatInterface {

    protected $data = [];
    protected $type = null;

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setDataType(\Survey\Data\InputData\InputDataInterface $type)
    {
        $this->type = $type;
    }

    public function getData()
    {
        return $this->type->convertData($this->data, $this->format);
    }

}