<?php

namespace SudokuBundle\Services;


/**
 * Created by PhpStorm.
 * User: wingel
 * Date: 03/06/17
 * Time: 22:25
 */
class ConvertCsvToArray
{
    public function __construct()
    {
    }

    public function convert($filename, $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }
        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                    foreach ($row as $utilisateur){
                        $data[] = explode(',', $utilisateur) ;
                    }

            }
            fclose($handle);
        }
        return $data;
    }
}