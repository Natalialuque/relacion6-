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
<p>Al ser clase abstracta y padre, no podemos crear ninguno </p>
<?php
?>
<h4>Mueble Reciclado</h4>
<?php
// Crear el mueble
$m = new MuebleReciclado("silla eco","Maderas Sur","ESPAÑA",2022,"01/03/2022","31/12/2035",85.5,70);

// Añadir características
$m->anadirCaracteristicas("color", "verde", "plegable", true);

// Mostrar con __toString
echo "<p>$m</p>";

// Probar algun get
echo "<p>Nombre: " . $m->getNombre() . "</p>";
echo "<p>Fabricante: " . $m->getFabricante() . "</p>";

// Propiedades adicionales
print_r($m->damePropiedadesAdicionales());


// Máximo de muebles
$restantes = 0;
MuebleBase::puedeCrear($restantes);
echo "<p>Se pueden crear $restantes muebles mas</p>";

?>
<h4>Mueble Tradicional</h4>
<?php
$t = new MuebleTradicional("mesa roble","Maderas Sur","PORTUGAL",2022,"01/03/2022","31/12/2035",250.5,120.5,"S25");

//mostrar tu estring 
echo "<p>$t</p>";

//Probar algun get
echo "<p>Año: " . $t->getAnio() . "</p>";
echo "<p>Inicio venta: " . $t->getFechaIniVenta() . "</p>";

//propiedades adicioales
print_r($t->damePropiedadesAdicionales());

// Máximo de muebles
$restantes = 0;
MuebleBase::puedeCrear($restantes);
echo "<p>Se pueden crear $restantes muebles mas</p>";

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