<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 1"=>"ejercicio1.php"

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
<?php
}
