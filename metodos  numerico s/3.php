<?php
// Función f(x) y su derivada f'(x)
function funcion($x) {
    return 0.95 * pow($x, 3) - 5.9 * pow($x, 2) + 10.9 * $x - 6;
}
function derivadaFuncion($x) {
    return 2.85 * pow($x, 2) - 11.8 * $x + 10.9;
}
// Método de Newton-Raphson
function newtonRaphson($xi, $iteraciones) {
    for ($i = 0; $i < $iteraciones; $i++) {
        $f_xi = funcion($xi);
        $df_xi = derivadaFuncion($xi);
        $xi = $xi - $f_xi / $df_xi;
    }
    return $xi;
}
// Método de la secante
function metodoSecante($x0, $x1, $iteraciones) {
    for ($i = 0; $i < $iteraciones; $i++) {
        $f_x0 = funcion($x0);
        $f_x1 = funcion($x1);
        $xi = $x1 - $f_x1 * ($x1 - $x0) / ($f_x1 - $f_x0);
        $x0 = $x1;
        $x1 = $xi;
    }
    return $xi;
}
// Método de la secante modificada
function secanteModificada($xi, $delta, $iteraciones) {
    for ($i = 0; $i < $iteraciones; $i++) {
        $f_xi = funcion($xi);
        $f_xi_delta = funcion($xi + $delta);
        $xi = $xi - $f_xi * $delta / ($f_xi_delta - $f_xi);
    }
    return $xi;
}

// Valores iniciales y número de iteraciones
$xi_newton = 3.5;
$iteraciones = 3;
$x0_secante = 2.5;
$x1_secante = 3.5;
$xi_modificada = 3.5;
$delta = 0.01;

// Llamadas a las funciones y salida
echo "<br>";
$raizNewton = newtonRaphson($xi_newton, $iteraciones);
echo "<span> <p style='font-weight: bold'>Raíz con Newton-Raphson:</p>  $raizNewton </span>" ."<br>";
echo "<br>";
$raizSecante = metodoSecante($x0_secante, $x1_secante, $iteraciones);
echo "<span> <p style='font-weight: bold'>Raíz con método de la secante:</p> $raizSecante </span>". "<br>";
echo "<br>";
$raizModificada = secanteModificada($xi_modificada, $delta, $iteraciones);
echo "<span> <p style='font-weight: bold'>Raíz con método de la secante modificada:</p>   $raizModificada</span>" .  "<br>" ;