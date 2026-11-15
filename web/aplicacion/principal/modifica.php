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
 * Recuperamos el mueble enviado desde index.php
 */
$indice = (int)($_GET["mueble"] ?? 0);

if (!isset($muebles[$indice]))
{
    die("Mueble no encontrado");
}

$mueble = $muebles[$indice];

/*
 * Procesamiento del formulario
 */
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $nombre = trim($_POST["nombre"]);
    $fabricante = trim($_POST["fabricante"]);
    $pais = trim($_POST["pais"]);
    $anio = (int)$_POST["anio"];
    $fechaIni = trim($_POST["fechaIni"]);
    $fechaFin = trim($_POST["fechaFin"]);
    $precio = (float)$_POST["precio"];

    /*
     * Validaciones directas
     */

    if ($nombre == ""){
        $errores[] = "Nombre obligatorio";
    }

    if ($anio < 2020){
        $errores[] = "Año incorrecto";
    }

    if ($precio < 30){
        $errores[] = "Precio incorrecto";
    }

    /*
     * Validaciones mediante setters
     */

    if (!$mueble->setFabricante($fabricante)){
        $errores[] = "Fabricante incorrecto";
    }

    if (!$mueble->setPais($pais)){
        $errores[] = "Pais incorrecto";
    }

    if (!$mueble->setFechaIniVenta($fechaIni)){
        $errores[] = "Fecha inicio incorrecta";
    }

    if (!$mueble->setFechaFinVenta($fechaFin)){
        $errores[] = "Fecha fin incorrecta";
    }

    /*
     * Si no hay errores actualizamos
     */

    if (empty($errores)){
        $mueble->setNombre($nombre);
        $mueble->setAnio($anio);
        $mueble->setPrecio($precio);

        /*
         * Propiedades especificas
         */

        if ($mueble instanceof MuebleReciclado){
            $porcentaje =
                (int)$_POST["porcentaje"];

            if (!$mueble->setPorcentajeReciclado(
                    $porcentaje))
            {
                $errores[] =
                    "Porcentaje incorrecto";
            }
        }

        if ($mueble instanceof MuebleTradicional){
            $peso =
                (float)$_POST["peso"];

            $serie =
                trim($_POST["serie"]);

            if (!$mueble->setPeso($peso)) {
                $errores[] =
                    "Peso incorrecto";
            }

            if (!$mueble->setSerie($serie)){
                $errores[] =
                    "Serie incorrecta";
            }
        }

        if (empty($errores)){
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
cuerpo($mueble,$errores,$resumen);
finCuerpo();


function cabecera()
{
}

function cuerpo($mueble,array $errores,bool $resumen){
?>
<h2>Modificar Mueble</h2>
<?php
//funcion para los errores
if (!empty($errores)){
    echo "<div class='error'>";

    foreach ($errores as $error){
        echo $error . "<br>";
    }

    echo "</div>";
}

?>
<!-- formulario con cada uno de los apartados a modificar -->
<form method="POST">

    <label>Nombre</label>
    <input
        type="text"
        name="nombre"
        value="<?= $mueble->getNombre() ?>">

    <br><br>

    <label>Fabricante</label>
    <input
        type="text"
        name="fabricante"
        value="<?= $mueble->getFabricante() ?>">

    <br><br>

    <label>Pais</label>
    <input
        type="text"
        name="pais"
        value="<?= $mueble->getPais() ?>">

    <br><br>

    <label>Año</label>
    <input
        type="number"
        name="anio"
        value="<?= $mueble->getAnio() ?>">

    <br><br>

    <label>Fecha inicio venta</label>
    <input
        type="text"
        name="fechaIni"
        value="<?= $mueble->getFechaIniVenta() ?>">

    <br><br>

    <label>Fecha fin venta</label>
    <input
        type="text"
        name="fechaFin"
        value="<?= $mueble->getFechaFinVenta() ?>">

    <br><br>

    <label>Precio</label>
    <input
        type="number"
        name="precio"
        value="<?= $mueble->getPrecio() ?>">

    <br><br>

<?php
/**en el caso de que estemos en un mueble reciclado debe aparece tambien el porcentaje */
if ($mueble instanceof MuebleReciclado){
?>
    <label>Porcentaje reciclado</label>

    <input
        type="number"
        name="porcentaje"
        value="<?= $mueble->getPorcentajeReciclado() ?>">

    <br><br>

<?php
}
/**En el cado de que estemos en un mueble tradicional debe aparecer peso y serie */
if ($mueble instanceof MuebleTradicional){
?>

    <label>Peso</label>

    <input
        type="number"
        name="peso"
        value="<?= $mueble->getPeso() ?>">

    <br><br>

    <label>Serie</label>

    <input
        type="text"
        name="serie"
        value="<?= $mueble->getSerie() ?>">

    <br><br>

<?php
}
?>

    <input
        type="submit"
        value="Modificar Mueble">

</form>

<?php
/**Resumen final de los datos a mostrar */
if ($resumen){
    echo "<h2>Resumen</h2>";

    echo "<p>Nombre: "
        . $mueble->getNombre()
        . "</p>";


    echo "<p>Fabricante: "
        . $mueble->getFabricante()
        . "</p>";

    echo "<p>Pais: "
        . $mueble->getPais()
        . "</p>";

    echo "<p>Año: "
        . $mueble->getAnio()
        . "</p>";

    echo "<p>Precio: "
        . $mueble->getPrecio()
        . "</p>";

}

}
