<?php

/**
 * 2. Buat fungsi untuk menghilangkan angka yang sama dari array , tanpa menggunakan fungsi array_unique
 * Example
 * Input : $array_number = [1,1,4,4,4,5,5,6,8,9,10,10,12,13,13,17]
 * Output : 1,4,5,6,8,9,10,12,13,17
 */

function removeDuplicates(array $array_number): string
{
    $result = [];

    foreach ($array_number as $number) {
        $exist = false;

        foreach ($result as $item) {
            if ($number == $item) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $result[] = $number;
        }
    }

    return implode(', ', $result);
}

$array_number = [1, 1, 4, 4, 4, 5, 5, 6, 8, 9, 10, 10, 12, 13, 13, 17];

echo removeDuplicates($array_number);
echo "\n";
