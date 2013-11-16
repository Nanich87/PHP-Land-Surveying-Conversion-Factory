<?php

namespace Survey\Format\OutputFormat;

interface OutputFormatInterface {

    public function setData($data);

    public function setDataType(\Survey\Data\InputData\InputDataInterface $type);

    public function getData();
}