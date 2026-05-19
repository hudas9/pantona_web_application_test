<?php

/**
 * 1.⁠ ⁠Buat fungsi untuk mencari angka 'Median' dari sebuah array yang tidak terurut, tanpa menggunakan fungsi sort bawaan.
 */

function findMedian(array $array)
{
    $length = count($array);

    for ($i = 0; $i < $length - 1; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }

    if ($length % 2 == 0) {
        $middle1 = ($length / 2) - 1;
        $middle2 = ($length / 2);

        $median = ($array[$middle1] + $array[$middle2]) / 2;
    } else {
        $middle = ($length - 1) / 2;

        $median = $array[$middle];
    }

    return $median;
}

$array_number = [2, 1, 5, 7, 4, -8, -3, -1]; // [-8, -3, -1, 1, 2, 4, 5, 7];
$array_number2 = [2, 1, 5, 7, 2, 4, -8, -3, -1]; // [-8, -3, -1, 1, 2, 4, 5, 7];

echo findMedian($array_number);
echo "\n";
echo findMedian($array_number2);
echo "\n";
