<?php
/**
 * DATOS DE LA TIENDA
 * Array indexado (posiciones a partir de 1) con 5 muebles.
 * Se define en un único punto y se incluye desde todas las páginas.
 */

$muebles = [];

// 1 - Mueble reciclado
$muebles[1] = new MuebleReciclado(
    "silla eco", "Maderas Sur", "ESPAÑA", 2022,
    "01/03/2022", "31/12/2035", 85.5, 70
);
$muebles[1]->anadirCaracteristicas("color", "verde", "plegable", true);

// 2 - Mueble tradicional
$muebles[2] = new MuebleTradicional(
    "mesa roble", "Carpintería Norte", "PORTUGAL", 2021,
    "01/06/2021", "31/12/2038", 250.5, 120.5, "S25"
);
$muebles[2]->anadirCaracteristicas("barnizado", true, "patas", 4);

// 3 - Mueble reciclado
$muebles[3] = new MuebleReciclado(
    "estante palet", "Reciclados Levante", "ESPAÑA", 2023,
    "01/01/2023", "31/12/2040", 60, 95
);
$muebles[3]->anadirCaracteristicas("baldas", 3, "material", "madera de palet");

// 4 - Mueble tradicional
$muebles[4] = new MuebleTradicional(
    "armario clasico", "Hnos. García", "ESPAÑA", 2020,
    "01/02/2020", "31/12/2039", 480, 210, "S10"
);
$muebles[4]->anadirCaracteristicas("puertas", 3, "espejo", true);

// 5 - Mueble reciclado
$muebles[5] = new MuebleReciclado(
    "banco jardin", "EcoMuebles", "FRANCIA", 2024,
    "01/05/2024", "31/12/2036", 120, 50
);
$muebles[5]->anadirCaracteristicas("exterior", true, "longitud", 150);

