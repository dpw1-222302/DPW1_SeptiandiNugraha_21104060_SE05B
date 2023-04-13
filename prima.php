<?php
function isPrime($num)
{
    // Jika bilangan <= 1 maka bukan bilangan prima
    if ($num <= 1) {
        return false;
    }

    // Cek apakah bilangan lebih dari 2 dan genap
    if ($num % 2 == 0 && $num > 2) {
        return false;
    }

    // Lakukan pengecekan pada bilangan ganjil
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0) {
            return false;
        }
    }

    // Jika tidak terpenuhi maka bilangan prima
    return true;
}

// Menampilkan bilangan prima dari 1 sampai 100
for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . "  adalah bilangan prima <br>";
    }
}
?>