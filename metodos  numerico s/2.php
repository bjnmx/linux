<?php
// Constantes
const G = 9.81; // Aceleración debido a la gravedad (m/s^2)
const Q = 20.0; // Caudal (m^3/s)

// Función para calcular el área de la sección transversal (Ac)
function calcularArea($y) {
    return 3 * $y + ($y * $y) / 2.0;
}

// Función para calcular el ancho del canal en la superficie (B)
function calcularAncho($y) {
    return 3.0 + $y;
}

// Función para la ecuación que queremos resolver
// f(y) = 1 - Q^2 / (g * Ac^3 * B)
function funcion($y) {
    $Ac = calcularArea($y);
    $B = calcularAncho($y);
    return 1.0 - (Q * Q) / (G * pow($Ac, 3) * $B);
}

// Derivada de la función f(y) respecto a y (para el método de Newton-Raphson)
function derivadaFuncion($y) {
    $Ac = calcularArea($y);
    $B = calcularAncho($y);
    $dAc_dy = 3.0 + $y; // Derivada de Ac respecto a y
    $dB_dy = 1.0;       // Derivada de B respecto a y

    // Derivada de f(y)
    return (6 * Q * Q * $dAc_dy) / (G * pow($Ac, 4) * $B) - (Q * Q * $dB_dy) / (G * pow($Ac, 3) * pow($B, 2));
}

// Método de Newton-Raphson
function newtonRaphson($y0, $tol, $maxIter) {
    $y = $y0;
    for ($i = 0; $i < $maxIter; $i++) {
        $f_y = funcion($y);
        $df_y = derivadaFuncion($y);
        $yNuevo = $y - $f_y / $df_y;

        if (abs($yNuevo - $y) < $tol) {
            return $yNuevo;
        }

        $y = $yNuevo;
    }
    return false; // No convergió
}

// Valor inicial para y (profundidad crítica)
$y0 = 1.0; // Suposición inicial razonable
$tolerancia = 1e-6; // Tolerancia para la solución
$maxIteraciones = 100; // Máximo número de iteraciones

$profundidadCritica = newtonRaphson($y0, $tolerancia, $maxIteraciones);

if ($profundidadCritica === false) {
    echo "El método no convergió después de " . $maxIteraciones . " iteraciones.";
} else {
    echo "La profundidad crítica es: " . $profundidadCritica . " metros.";
}