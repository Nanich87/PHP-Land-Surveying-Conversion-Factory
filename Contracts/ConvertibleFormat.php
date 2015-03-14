<?php

namespace Contracts;

interface ConvertibleFormat {

    public function convert($data, $format);
}