<?php

namespace Survey\Format\OutputFormat;

class GPX_Format extends \Survey\Format\OutputFormat\Base_Format {

    protected $format = 'GPX';

    public function __construct($data, \Contracts\ConvertibleFormat $format) {
        parent::__construct($data, $format);
    }

}