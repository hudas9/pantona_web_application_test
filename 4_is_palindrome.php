<?php

/**
 * 4. Buat fungsi untuk mengecek string memiliki kata yang simetris tanpa menggunakan fungsi php strrev, contohnya madam, tutut, jika kata yang dikirim simetris, return TRUE, jika tidak return FALSE
 * Example 1
 * Input : $str = madam
 * Output : TRUE
 * Example 2
 * Input : $str = gozaru
 * Output : FALSE
 */

function isPalindrome(string $str): bool
{
    $str = strtolower(str_replace(' ', '', $str));
    $length = strlen($str);

    for ($i = 0; $i < $length / 2; $i++) {
        if ($str[$i] !== $str[$length - $i - 1]) {
            return false;
        }
    }

    return true;
}

$str = "Madam";
$str2 = "gozaru";
$str3 = "Kasur Rusak";

var_dump(isPalindrome($str));
var_dump(isPalindrome($str2));
var_dump(isPalindrome($str3));
