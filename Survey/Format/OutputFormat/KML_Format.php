<?php

namespace Survey\Format\OutputFormat;

class KML_Format extends \Survey\Format\OutputFormat\General_Format {

    protected $format = 'KML';

    public function __construct($data, \Survey\Data\InputData\InputDataInterface $type) {
        parent::__construct($data, $type);
    }

}