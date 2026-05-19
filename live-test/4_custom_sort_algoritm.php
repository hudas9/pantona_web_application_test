<?php

/**
 * 4.⁠ ⁠di test custom_sort, algoritma apa yang dipakai?
 */


function customeSort(array $array_number): string
{
    $length = count($array_number);

    // Algoritma Bubble Sort
    // Algoritma yang membandingkan sebuah nilai dengan nilai yang berada disebelahnya
    // pada contoh kode dibawah index $j akan dibandingkan dengan index sebelahnya ($j +1)
    // jika $j lebih besar dari angka setelahnya, maka nilai dari kedua bilangan tersebut akan ditukar
    // misal, [5, 2, 4, 1],
    // alur kerja algoritmanya adalah
    // 5 -> 2, karena 5 lebih besar dari 2, maka angkanya ditukar dan menjadi [2, 5, 4, 1]
    // 5 -> 4,  karena 5 lebih besar dari 4, maka angkanya ditukar dan menjadi [2, 4, 5, 1]
    // dan seterusnya sampai semua angka urut
    for ($i = 0; $i < $length - 1; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($array_number[$j] > $array_number[$j + 1]) {
                $temp = $array_number[$j];
                $array_number[$j] = $array_number[$j + 1];
                $array_number[$j + 1] = $temp;
            }
        }
    }

    return implode(', ', $array_number);
}
