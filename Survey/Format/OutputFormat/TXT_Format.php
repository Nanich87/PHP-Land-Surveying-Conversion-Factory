<?php

namespace Survey\Format\OutputFormat;

class TXT_Format extends \Survey\Format\OutputFormat\Base_Format {

    protected $format = 'TXT';

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        parent::__construct($data, $format);
    }

}