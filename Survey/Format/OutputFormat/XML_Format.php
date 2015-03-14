<?php

namespace Survey\Format\OutputFormat;

class XML_Format extends \Survey\Format\OutputFormat\General_Format {

    protected $format = 'XML';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type) {
        parent::__construct($data, $type);
    }

}