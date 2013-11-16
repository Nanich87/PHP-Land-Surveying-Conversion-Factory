<?php

namespace Survey\Data\InputData;

interface InputDataInterface {

    public function convertData($outputData, $outputFormat);
}