<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "PRUEBAS"=> "pruebas.php",

 ];


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION",$ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo()
{
?>
<h1>PRUEBAS DE LAS CLASES</h1>
<h4>Mueble Base</h4>
<?php

?>
<h4>Mueble Reciclado</h4>
<?php

?>
<h4>Caracteristicas</h4>
<?php
$c = new Caracteristicas();

$c->color = "rojo";
$c->peso = 20;
$c->material = "madera";
$c->ULTIMA = "casa";

echo $c;


}