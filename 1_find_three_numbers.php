<?php

/**
 * 1. Buat fungsi untuk mencari 3 angka dari array, yang ketika dijumlahkan menghasilkan nilai 0, jika tidak ada, return “Not Found”, jika ada ,return angka sesuai urutan penjumlahan
 * Example
 * Input : $array_number = [2,1,5,7,4,-8,-3,-1]
 * Output : -3,1,2
 * (-3 + 1 + 2 = 0)
 */

function findThreeNumbers(array $array_number): string
{
    $length = count($array_number);

    for ($i = 0; $i < $length - 2; $i++) {
        for ($j = $i + 1; $j < $length - 1; $j++) {
            for ($k = 0; $k < $length; $k++) {
                if ($array_number[$i] + $array_number[$j] + $array_number[$k] == 0) {
                    $result = [$array_number[$i], $array_number[$j], $array_number[$k]];
                    sort($result);
                    return implode(', ', $result);
                }
            }
        }
    }
    return 'Not Found';
}

$array_number = [2, 1, 5, 7, 4, -8, -3, -1];

echo findThreeNumbers($array_number);
echo "\n";
