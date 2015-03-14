<?php

function __autoload($className)
{
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    if (file_exists($className . '.php'))
    {
        require_once($className . '.php');
    }
}

$inputFileTypeList = \Survey\Format\InputFormat\Base_Format::getSupportedInputFormats();
$outputFileTypeList = \Survey\Format\InputFormat\Base_Format::getSupportedOutputFormats();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Конвертиране на геодезически файлове</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <form method="post" action="">
                <ul>
                    <li><label for="fileContent">Файл:</label><textarea id="fileContent" name="fileContent"></textarea></li>
                    <li><label for="inputFile">Входен формат:</label>
                        <select name="inputFile" id="inputFile">
                            <?php
                            foreach ($inputFileTypeList as $inputFile)
                            {
                                echo '<option value="' . $inputFile['id'] . '">' . $inputFile['type'] . '</option>';
                            }
                            ?>
                        </select>  
                    </li>
                    <li>
                        <label for="outputFormat">Изходен формат:</label>
                        <select name="outputFile" id="outputFile">
                            <?php
                            foreach (array_keys($outputFileTypeList) as $outputFile)
                            {
                                echo '<option value="' . $outputFile . '">' . $outputFile . '</option>';
                            }
                            ?>
                        </select>  
                    </li>
                    <li><input type="submit" name="submit" value="Конвертиране" /></li>
                </ul>
            </form>
            <?php
            if (isset($_POST['submit']))
            {
                $elevationsList = array();

                try
                {
                    $inputString = $_POST['fileContent'];
                    // създаване на нов файл
                    $newFile = \Patterns\Factory\InputFormatFactory::create($inputString, $_POST['inputFile'], $_POST['outputFile']);
                    // конвертиране на входния файл в зададения изходенн формат
                    $newFile->convert();
                    // показване на конвертирания файл като символен низ
                    echo $newFile->toString();
                }
                catch (\Exception $e)
                {
                    echo $e->getFile();
                    echo $e->getLine();
                }
            }
            ?>
        </div>
    </body>
</html>