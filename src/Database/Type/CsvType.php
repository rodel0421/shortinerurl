<?php

namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

class CsvType extends Type
{

    public function toPHP($value, Driver $driver)
    {
        if ($value === null || $value == '') {
            return [];
        }
        return str_getcsv($value);
    }

    public function marshal($value)
    {
        if (is_array($value) || $value === null) {
            return $value;
        }
        return str_getcsv($value);;
    }

    public function toDatabase($value, Driver $driver)
    {
        return $this->str_putcsv($value);
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
    
    private function str_putcsv($input, $delimiter = ',', $enclosure = '"')
    {
        // Open a memory "file" for read/write...
        $fp = fopen('php://temp', 'r+');
        // ... write the $input array to the "file" using fputcsv()...
        fputcsv($fp, $input, $delimiter, $enclosure);
        // ... rewind the "file" so we can read what we just wrote...
        rewind($fp);
        // ... read the entire line into a variable...
        $data = fread($fp, 1048576);
        // ... close the "file"...
        fclose($fp);
        // ... and return the $data to the caller, with the trailing newline from fgets() removed.
        return rtrim($data, "\n");
    }

}