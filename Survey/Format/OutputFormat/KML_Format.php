<?php

namespace Survey\Format\OutputFormat;

class KML_Format extends \Survey\Format\OutputFormat\Base_Format {

    protected $format = 'KML';

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        parent::__construct($data, $format);
    }

}