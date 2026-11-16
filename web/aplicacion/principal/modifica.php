<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . "/muebles.php");


$ubicacion = [
    "pagina principal" => "../../index.php",
    "modifica" => "modifica.php"
];

//CONTROLADOR                                              

$errores = [];
$resumen = false;

/*
 * Recuperamos el mueble enviado desde index.php mediante su indice
 */
$indice = (int)($_GET["mueble"] ?? 0);

$mueble = null;

if (array_key_exists($indice, $muebles)) {
    $mueble = $muebles[$indice];
}
else {
    $errores[] = "Mueble no encontrado";
}


/*
 * Hacemos que el formulario funcione unicamente cuando-->
 * - Se ha enviado por método POST
 * - Existe un mueble válido sobre el que trabajar
 */
if ($_SERVER["REQUEST_METHOD"] === "POST" && $mueble !== null) {

    /*
     * Recogida de datos del formulario
     */
    $nombre = trim($_POST["nombre"]);
    $fabricante = trim($_POST["fabricante"]);
    $pais = trim($_POST["pais"]);
    $anio = (int)$_POST["anio"];
    $fechaIni = trim($_POST["fechaIni"]);
    $fechaFin = trim($_POST["fechaFin"]);
    $precio = (float)$_POST["precio"];

    /*
     * Validaciones realizadas directamente mediante condiciones
     */

    if ($nombre == "") {
        $errores[] = "Nombre obligatorio";
    }

    if ($anio < 2020) {
        $errores[] = "Año incorrecto";
    }

    if ($precio < 30) {
        $errores[] = "Precio incorrecto";
    }

    /*
     * Validaciones realizadas utilizando los métodos set de la clase
     */

    if (!$mueble->setFabricante($fabricante)) {
        $errores[] = "Fabricante incorrecto";
    }

    if (!$mueble->setPais($pais)) {
        $errores[] = "Pais incorrecto";
    }

    if (!$mueble->setFechaIniVenta($fechaIni)) {
        $errores[] = "Fecha inicio incorrecta";
    }

    if (!$mueble->setFechaFinVenta($fechaFin)) {
        $errores[] = "Fecha fin incorrecta";
    }

    /*
     * Si no hay errores actualizamos las propiedades comunes del mueble
     */
    if (empty($errores)) {

        $mueble->setNombre($nombre);
        $mueble->setAnio($anio);
        $mueble->setPrecio($precio);

        /*
         * Validación y actualización de propiedades específicas según el tipo de mueble
         */

        if ($mueble instanceof MuebleReciclado) {

            $porcentaje = (int)$_POST["porcentaje"];

            if (!$mueble->setPorcentajeReciclado($porcentaje)) {
                $errores[] = "Porcentaje incorrecto";
            }
        }

        if ($mueble instanceof MuebleTradicional) {

            $peso = (float)$_POST["peso"];
            $serie = trim($_POST["serie"]);

            if (!$mueble->setPeso($peso)) {
                $errores[] = "Peso incorrecto";
            }

            if (!$mueble->setSerie($serie)) {
                $errores[] = "Serie incorrecta";
            }
        }

        /*
         * Si después de todas las comprobaciones sigue sin haber errores, activamos el resumen
         */
        if (empty($errores)) {
            $resumen = true;
        }
    }
}

// **********************************************************
////vista cabecera donde podemos ver otros enlaces    
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $ubicacion);
if ($mueble !== null) {
    cuerpo($mueble, $errores, $resumen);
}
else {
    mostrarErrores($errores);
}
finCuerpo();


function cabecera(){
}

/**
 * FUNCION CUERPO --> Se encarga de recoger las funciones de errore, formulario y resumen
 *
 * @param [type] $mueble
 * @param array $errores
 * @param boolean $resumen
 * @return void
 */
function cuerpo($mueble, array $errores, bool $resumen){
?>
    <h2>Modificar Mueble</h2>

<?php
    mostrarErrores($errores);

    formularioMueble($mueble);

    if ($resumen) {
        resumenMueble($mueble);
    }
}

/**
* FUNCION ERRORES --> Se encarga de mostrar los errores que se crean cuando hay datos incorrectos en el formulario 
*
* @param array $errores
* @return void
*/
function mostrarErrores(array $errores): void{
    if (!empty($errores)) {
        echo "<div class='error'>";

        foreach ($errores as $error) {
            echo $error . "<br>";
        }
        echo "</div>";
    }
}

/**
 * FUNCION FORMULARIO --> Esta funcion mediante metodo post nos muestra un formulario modificlable con los datos del mueble selecionado
 *
 * @param [type] $mueble
 * @return void
 */
function formularioMueble($mueble): void{
?>
    <form method="POST">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $mueble->getNombre() ?>">

        <br><br>

        <label>Fabricante</label>
        <input type="text" name="fabricante" value="<?= $mueble->getFabricante() ?>">

        <br><br>

        <label>Pais</label>
        <input type="text" name="pais" value="<?= $mueble->getPais() ?>">

        <br><br>

        <label>Año</label>
        <input type="number" name="anio" value="<?= $mueble->getAnio() ?>">

        <br><br>

        <label>Fecha inicio venta</label>
        <input type="text" name="fechaIni" value="<?= $mueble->getFechaIniVenta() ?>">

        <br><br>

        <label>Fecha fin venta</label>
        <input type="text" name="fechaFin" value="<?= $mueble->getFechaFinVenta() ?>">

        <br><br>

        <label>Precio</label>
        <input type="number" name="precio" value="<?= $mueble->getPrecio() ?>">
        
        <br><br>

        <label>Material</label>
        <input type="text" name="material" value="<?= $mueble->getMaterialesDescripcion() ?>">

        <br><br>

    <?php
        //Para mostrar cuando es mueble reciclado
        if ($mueble instanceof MuebleReciclado) {
    ?>
            <label>Porcentaje reciclado</label>
            <input type="number" name="porcentaje" value="<?= $mueble->getPorcentajeReciclado() ?>">

            <br><br>
    <?php
        }

        //Para mostrar cuando es mueble tradiconal
        if ($mueble instanceof MuebleTradicional) {
    ?>
            <label>Peso</label>
            <input type="number" name="peso" value="<?= $mueble->getPeso() ?>">

            <br><br>

            <label>Serie</label>
            <input type="text" name="serie" value="<?= $mueble->getSerie() ?>">

            <br><br>
    <?php
        }
    ?>

        <input type="submit" value="Modificar Mueble">

    </form>
<?php
}

/**
 * FUNCION RESUMEN --> Esta funcion es la que muestra un resumen del mueble una vez los campos modificados son validos
 *
 * @param [type] $mueble
 * @return void
 */
function resumenMueble($mueble): void{
    echo "<h2>Resumen</h2>";

    echo "<p>Nombre: " . $mueble->getNombre() . "</p>";
    echo "<p>Fabricante: " . $mueble->getFabricante() . "</p>";
    echo "<p>Pais: " . $mueble->getPais() . "</p>";
    echo "<p>Año: " . $mueble->getAnio() . "</p>";
    echo "<p>Precio: " . $mueble->getPrecio() . "</p>";
    echo "<p>Materiales: " . $mueble->getMaterialesDescripcion() . "</p>";


    /**
     * Si el mueble es reciclado hay que tener en cuenta que tenemos una variable mas de porcentaje 
     */
    if ($mueble instanceof MuebleReciclado) {
        echo "<p>Porcentaje reciclado: "
            . $mueble->getPorcentajeReciclado()
            . "</p>";
    }

    /**
     * Si el mueble es tradiciconal hay que tener en cuenta que tenemos dos variables mas de peso y serie
     */
    if ($mueble instanceof MuebleTradicional) {
        echo "<p>Peso: "
            . $mueble->getPeso()
            . "</p>";

        echo "<p>Serie: "
            . $mueble->getSerie()
            . "</p>";
    }
}