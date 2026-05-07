<?php

/**
 * 3. Buat fungsi untuk sorting angka dari array tanpa menggunakan fungsi php array_sort , sorting secara ascending, namun setiap keliapan 5 angka dari array tersorting, metode sorting berubah dari ascending ke descending, dan berubah lagi sebaliknya setiap keliapatan 5 angka
 * Example
 * Input :
 * $array_number = [2,5,1,12,-5,4,-1,3,-3,20,8,7,-2,6,9]
 * Output : -5,-3,-2,-1,1,20,12,9,8,7,2,3,4,5,6
 */

function customeSort(array $array_number): string
{
    $length = count($array_number);

    for ($i = 0; $i < $length - 1; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($array_number[$j] > $array_number[$j + 1]) {
                $temp = $array_number[$j];
                $array_number[$j] = $array_number[$j + 1];
                $array_number[$j + 1] = $temp;
            }
        }
    }


    $left = 0;
    $right = $length - 1;
    $result = [];
    $ascending = true;

    while ($left <= $right) {
        if ($ascending) {
            for ($i = 0; $i < 5 && $left <= $right; $i++) {
                $result[] = $array_number[$left];
                $left++;
            }
        } else {
            for ($i = 0; $i < 5 && $left <= $right; $i++) {
                $result[] = $array_number[$right];
                $right--;
            }
        }

        $ascending = !$ascending;
    }

    return implode(', ', $result);
}

$array_number = [2, 5, 1, 12, -5, 4, -1, 3, -3, 20, 8, 7, -2, 6, 9];

echo customeSort($array_number);
echo "\n";
