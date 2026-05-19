<?php

/**
 * 1.⁠ ⁠Buat fungsi untuk mencari angka 'Median' dari sebuah array yang tidak terurut, tanpa menggunakan fungsi sort bawaan.
 */

function findMedian(array $array): int
{
    $length = count($array);

    for ($i = 0; $i < $length - 1; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array_number[$j + 1] = $temp;
            }
        }
    }

    $median_number = 0;

    // for ($i=0; $i < $length / 2; $i++) {
    //     $median_number =
    // }
}

$array_number = [2, 1, 5, 7, 4, -8, -3, -1]; // [-8, -3, -1, 1, 2, 4, 5, 7];

echo findMedian($array_number);
echo "\n";
