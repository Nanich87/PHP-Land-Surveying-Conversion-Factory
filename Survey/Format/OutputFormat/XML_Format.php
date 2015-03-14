<?php

namespace Survey\Format\OutputFormat;

class XML_Format extends \Survey\Format\OutputFormat\Base_Format {

    protected $format = 'XML';

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        parent::__construct($data, $format);
    }

}