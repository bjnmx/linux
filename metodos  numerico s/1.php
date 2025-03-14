<?php
define('w', 100); // Define a constant named 'W'

// Parámetros del problema
$L1 = 6.0; // Longitud del tramo con carga distribuida (ft)
$L2 = 4.0; // Longitud del tramo sin carga (ft)
$w = 100.0; // Carga distribuida máxima (lb/ft)
$P = 100.0; // Carga puntual al final (lb)

// Reacciones calculadas por equilibrio
$RA = (w * $L1 / 2.0 + $P * ($L1 + $L2)) / ($L1 + $L2 + 2.0);

// Intervalo inicial para la bisección
$a = 0.0;
$b = $L1 + $L2;
$tol = 1e-6;

// Encontrar la raíz utilizando el método de bisección
$raiz = biseccion($a, $b, $tol, 'momentoEnX', $RA, $L1, $L2, $w, $P);

echo "La posición donde el momento es cero es: " . $raiz . " ft\n";

function momentoEnX($x, $RA, $L1, $L2, $P, $w) {
    // Calcula el momento flector en la posición x de una viga
    // con carga distribuida triangular y uniforme, y una carga puntual

    $momento = 0.0;

    // Momento por la carga distribuida (triangular + uniforme)
    if ($x <= $L1) {
        $q = $w * ($x / $L1); // Carga lineal en x
        $distancia = $x / 3.0; // Centroide de la carga triangular
        $momento -= ($q * $x / 2.0) * $distancia;
    } else if ($x <= ($L1 + $L2)) {
        $q = $w;
        $dx = $x - $L1;
        $momento -= ($q * $dx) * ($dx / 2.0);
    }

    // Momento por la carga puntual en el extremo derecho
    if ($x > ($L1 + $L2)) {
        $dx = $x - ($L1 + $L2);
        $momento -= $P * $dx;
    }

    // Momento por la reacción en el apoyo A
    $momento += $RA * $x;

    return $momento;
}

function biseccion($a, $b, $tol, $f, $RA, $L1, $L2, $w, $P) {
    // Método de bisección para encontrar la raíz de una función
    while (abs($b - $a) > $tol) {
        $c = ($a + $b) / 2;
        $fc = $f($c, $RA, $L1, $L2, $w, $P);
        if ($fc == 0) {
            return $c;
        } elseif ($f($a, $RA, $L1, $L2, $w, $P) * $fc < 0) {
            $b = $c;
        } else {
            $a = $c;
        }
    }
    return $c;
}