<?php

namespace Survey\Format\OutputFormat;

class JSON_Format extends \Survey\Format\OutputFormat\General_Format {

    protected $format = 'JSON';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type)
    {
        parent::__construct($data, $type);
    }

}