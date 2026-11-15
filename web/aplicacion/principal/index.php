<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . "/muebles.php");

/* barra de ubicación */
$ubicacion = [
    "pagina principal" => "../../index.php",
    "TIENDA" => "TIENDA"
];

//CONTROLADOR                                                  

//datos vista
$datos = [
    "mueble" => null
];

//errores
$errores = [];

//mueble
$objMueble = null;

/**
 * 
 */
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $indice = (int)($_POST["mueble"] ?? 0);

    if (!array_key_exists($indice, $muebles)){
        $errores["mueble"][] ="El mueble seleccionado no existe";
    }else{
        $datos["mueble"] = $indice;
        $objMueble = $muebles[$indice];
    }

    /*
     * Botón mostrar
     */
    if (isset($_POST["mostrar"])&& empty($errores)){
        //el resultado se mostrará en la vista
    }


    /*
     * Botón modificar
     */
    if (isset($_POST["modificar"]) && empty($errores))
    {
        header("Location: modifica.php?mueble=". urlencode($indice));
        exit;
    }
}

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("TIENDA",$ubicacion);
cuerpo($muebles,$datos,$errores,$objMueble);
finCuerpo();
//**********************************************************
//vista cabecera donde podemos ver otros enlaces 

//cabecera
function cabecera(){}


/*
 * Vista principal
 */
function cuerpo(array $muebles,array $datos,array $errores,$objMueble){
    
    tablaMuebles($muebles);

    echo "<br>";

    formulario($muebles,$datos,$errores);

    /*
     * Mostrar mueble seleccionado
     */
    if ( isset($_POST["mostrar"])&& empty($errores)&& $objMueble !== null){
        echo "<br>";

        mostrarMueble($objMueble);
    }
}

/**
 * FUNCION FORMULARIO PARA MOSTRAR EL FORMULARIO PRINCIPAL
 *
 * @param array $muebles
 * @param array $datos
 * @param array $errores
 * @return void
 */
function formulario(array $muebles,array $datos,array $errores){

    //esto se encarga de los errores
    if (!empty($errores)){
        echo "<div class='error'>";

        foreach ($errores as $listaErrores) {
            foreach ($listaErrores as $error) {
                echo "$error<br>";
            }
        }
        echo "</div>";
    }

?>

<form method="POST">
    <label for="mueble">
        Seleccione un mueble
    </label>

    <select name="mueble" id="mueble">

        <?php
        foreach ($muebles as $indice => $mueble){
        ?>
            <option
                value="<?= $indice ?>"

                <?= ($datos["mueble"] == $indice)? "selected": ""?>>

                <?= $indice ?>
                
                <?= $mueble->getNombre() ?>

            </option>

        <?php
        }
        ?>

    </select>
    <br><br>

    <input type="submit"name="mostrar"value="Mostrar Mueble">

    <input type="submit"name="modificar"value="Modificar Mueble">

</form>

<?php
}

/**
 * FUNCION QUE TE PINTA LA TABLA MUEBLES 
 *
 * @param array $muebles
 * @return void
 */
function tablaMuebles(array $muebles)
{
?>

<table border="1">

    <tr>
        <th>Indice</th>
        <th>Clase</th>
        <th>Nombre</th>
        <th>Fabricante</th>
        <th>Pais</th>
        <th>Año</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Precio</th>
    </tr>

<?php

foreach ($muebles as $indice => $mueble)
{
?>

    <tr>

        <td><?= $indice ?></td>

        <td><?= get_class($mueble) ?></td>

        <td><?= $mueble->getNombre() ?></td>

        <td><?= $mueble->getFabricante() ?></td>

        <td><?= $mueble->getPais() ?></td>

        <td><?= $mueble->getAnio() ?></td>

        <td><?= $mueble->getFechaIniVenta() ?></td>

        <td><?= $mueble->getFechaFinVenta() ?></td>

        <td><?= $mueble->getPrecio() ?> €</td>

    </tr>

<?php
}
?>

</table>

<?php
}

/**
 * FUNCION PARA MOSTRAR UN MUEBLE SEÑALADO EN EL COMBO
 *
 * @param [type] $mueble
 * @return void
 */
function mostrarMueble($mueble)
{
    echo "<h2>Mueble seleccionado</h2>";

    echo "<p>Clase: " . get_class($mueble) . "</p>";
    echo "<p>Nombre: " . $mueble->getNombre() . "</p>";
    echo "<p>Fabricante: " . $mueble->getFabricante() . "</p>";
    echo "<p>Pais: " . $mueble->getPais() . "</p>";
    echo "<p>Año: " . $mueble->getAnio() . "</p>";
    echo "<p>Fecha inicio venta: " .
            $mueble->getFechaIniVenta() .
            "</p>";

    echo "<p>Fecha fin venta: " .
            $mueble->getFechaFinVenta() .
            "</p>";

    echo "<p>Precio: " .
            $mueble->getPrecio() .
            " €</p>";
}