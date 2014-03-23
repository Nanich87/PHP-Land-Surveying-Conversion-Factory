<?php

namespace Survey\Format\OutputFormat;

class TXT_Format extends \Survey\Format\OutputFormat\General_Format {

    private $format = 'TXT';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type)
    {
        parent::__construct($data, $type);
    }

    public function getData()
    {
        return $this->type->convertData($this->data, $this->format);
    }

}