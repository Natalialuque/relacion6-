<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA N.C.L");
cuerpo("TIENDA");  //llamo a la vista
finCuerpo();
// **********************************************************

//vista cabecera donde podemos ver otros enlaces 
function cabecera() 
{
    /** */
}

//vista
function cuerpo()
{
?>
    <br><br>
     <h3 id="TituloCuerpo">Ejercicios</h3>
    <ul>
        

    </ul>   
        <br><br>

        <h3 id="TituloCuerpo">Pruebas<h3>
    <ul>
      

    </ul>
    
<?php
}
