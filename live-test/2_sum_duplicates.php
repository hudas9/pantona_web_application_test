<?php

/**
 * 2.⁠ ⁠dari fungsi remove_duplicate tampilkan angka yg dihapusnya kedalam array baru lalu dari array baru tersebut jumlahkan
 */

function sumDuplicates(array $array_number)
{
    $result = [];
    $duplicates = [];
    $totalDuplicates = 0;

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
        } else {
            $duplicates[] = $number;
        }
    }

    foreach ($duplicates as $value) {
        $totalDuplicates = $totalDuplicates + $value;
    }

    echo "Array yang unik : " . implode(', ', $result) . "\n";
    echo "Array yang dihapus : " . implode(', ', $duplicates) . "\n";
    echo "Total array yang dihapus : " . $totalDuplicates . "\n";
}

$array_number = [1, 1, 4, 4, 4, 5, 5, 6, 8, 9, 10, 10, 12, 13, 13, 17];

sumDuplicates($array_number);
