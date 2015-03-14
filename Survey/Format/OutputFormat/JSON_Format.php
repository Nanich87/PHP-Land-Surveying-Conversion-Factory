<?php

namespace Survey\Format\OutputFormat;

class JSON_Format extends \Survey\Format\OutputFormat\Base_Format {

    protected $format = 'JSON';

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        parent::__construct($data, $format);
    }

}