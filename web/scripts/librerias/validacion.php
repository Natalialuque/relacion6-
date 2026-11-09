<?php 

/**
 * function validaEntero(int &$var, int $min, int $max, int $defecto):bool Esta función
 * comprueba que $var contiene un entero cuyo valor está entre $min y $max. En $var se
 * devuelve el entero saneado (en caso de no cumplir las condiciones asigna a $var el valor
 * $defecto). La función devuelve true si es correcto y false en caso contrario.
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $defecto
 * @return boolean
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool{
    
    // Comprobamos si el valor está dentro del rango permitido
    if (is_int($var) && $var >= $min && $var <= $max) {
        return true;
    }

    // Si no cumple, asignamos el valor por defecto
    $var = $defecto;
    return false;
}


 /**
  *function validaReal(float &$var, float $min, float $max, float $defecto):bool Esta función
  *comprueba que $var contiene un real cuyo valor está entre $min y $max. En $var se devuelve
  *el real saneado (en caso de no cumplir las condiciones asigna a $var el valor $defecto). La
  *función devuelve true si es correcto y false en caso contrario.
  *
  * @param float $var
  * @param float $min
  * @param float $max
  * @param float $defecto
  * @return boolean
  */
 function validaReal(float &$var,float $min,float $max, float $defecto):bool{
    //comprobamos que este entre el rango, porque ya metemos en la funcion que tiene que ser FLOAT
    if($var >=$min && $var <= $max){
        return true;
    }

    //cambiamos por el defecto y devolvemos false
    $var=$defecto;
    return false;
 }


/**
 * function validaFecha(string &$var, string $defecto):bool Esta función comprueba que $var
 *contiene una fecha correcta en el formato dd/mm/aaaa. En $var se devuelve la fecha saneada
 *(2 cifras para dia y mes y cuatro para año- ej fecha 1/2/2023 es válida aunque se sanea y se
 *convierte en 01/02/2023). En caso de no cumplir las condiciones devuelve $defecto en
 *$var. La función devuelve true si es correcta y false en caso contrario.
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
 function validaFecha(string &$var, string $defecto):bool{
    // Divide la fecha usando "/" como separador
    $fecha = mb_split("/", trim($var));

    // Debe tener exactamente 3 partes:día, mes y año
    if (count($fecha) == 3) {

        // El año debe tener exactamente 4 cifras
        if (mb_strlen($fecha[2]) != 4) {
            $var = $defecto;
            return false;
        }

        // Si el día tiene una cifra añadimos un 0 delante
        if (mb_strlen($fecha[0]) == 1) {
            $fecha[0] = "0" . $fecha[0];
        }

        // Si el mes tiene una cifra añadimos un 0 delante
        if (mb_strlen($fecha[1]) == 1) {
            $fecha[1] = "0" . $fecha[1];
        }

        // Comprueba que la fecha exista realmente checkdate(mes, dia, año)
        if (checkdate((int)$fecha[1],(int)$fecha[0],(int)$fecha[2])) {
            $var = $fecha[0] . "/" . $fecha[1] . "/" .$fecha[2];
            return true;
        }
    }

    //si fecha no es valida cambiamos por la defecto 
    $var = $defecto;
    return false;
 }

 /**
 * function validaHora(string &$var, string $defecto):bool Esta función comprueba que $var
 *contiene una hora correcta en el formato hh:mm:ss . En $var se devuelve la hora saneada (2
 *cifras para hora, min, segundos - Ej 0:5:1, hora valida aunque se sanea y se convierte a
 *00:05:01). En caso de no cumplir las condiciones devuelve $defecto en $var. La función
 *devuelve true si es correcta y false en caso contrario
 * 
 * @param  $var
 * @param string $defecto
 * @return boolean
 */
function validaHora(string &$var, string $defecto): bool{
    // Divide la hora usando ":" como separador
    $hora = mb_split(":", trim($var));

    // Debe tener exactamente 3 partes ->hora, minuto y segundo
    if (count($hora) == 3) {

        // Si la hora tiene una sola cifra, añade un 0 delante
        if (mb_strlen($hora[0]) == 1) {
            $hora[0] = "0" . $hora[0];
        }

        // Si los minutos tienen una sola cifra, añade un 0 delante
        if (mb_strlen($hora[1]) == 1) {
            $hora[1] = "0" . $hora[1];
        }

        // Si los segundos tienen una sola cifra, añade un 0 delante
        if (mb_strlen($hora[2]) == 1) {
            $hora[2] = "0" . $hora[2];
        }

        // Convierte los valores a enteros para comprobar rangos
        $h = (int)$hora[0];
        $m = (int)$hora[1];
        $s = (int)$hora[2];

        // Comprueba que la hora sea válida
        if ($h >= 0 && $h <= 23 && $m >= 0 && $m <= 59 && $s >= 0 && $s <= 59) {

            $var = $hora[0] . ":" . $hora[1] . ":" . $hora[2];
            return true;
        }
    }

    // Si la hora no es valida cambiamos por defecto y devolvemos false
    $var = $defecto;
    return false;
}

/**
 * function validaEmail(string &$var, string $defecto):bool Esta función comprueba que $var
 * contiene un email correcto en el formato aaaaa@bbbb.ccc. En $var se devuelve el email
 * saneado (en caso de no cumplir las condiciones devuelve $defecto). La función devuelve
 * true si es correcto y false en caso contrario.
 *
 * @param  $var
 * @param string $defecto
 * @return boolean
 */
function validaEmail(string &$var, string $defecto): bool{
// Eliminar espacios y caracteres invisibles
    $var = trim($var);

    //expresion regular para verificar el email
    $email = '/^[\w-]+@[\w\-]+\.\w{2,}$/';

    //La función preg_match en PHP se utiliza para realizar coincidencias de patrones en cadenas.
    //comprobamos con la expre y devolvemos verdadero
    if (preg_match($email, $var)) {
        return true;
    } else {
        //si no es valido cambiamos por defecto y devolvemos falso
        $var = $defecto;
        return false;
    }

}

/**
 * function validaCadena(string &$var, int $longitud, string $defecto):bool Esta función
 * comprueba que $var contiene una cadena de longitud máxima $longitud. En caso de no
 * cumplir las condiciones se asigna a $var el valor $defecto. La función devuelve true si es
 * correcto y false en caso contrario.
 *
 * @param string $var
 * @param integer $longitud
 * @param string $defecto
 * @return boolean
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool{

    //verifica que la longitud no sea mayor y devuelve true
    if(mb_strlen($var) <= $longitud){
        return true;
    }

    //longitud mayor y la cambia por el defecto y devuelve false
    $var = $defecto;
    return false;
}

/**
 * function validaExpresion(string &$var, string $expresion, string $defecto):bool Esta función
 * comprueba que $var cumple con la expresión regular $expresion. En caso de no cumplir las
 * condiciones se asigna a $var el valor por $defecto. La función devuelve true si es correcto y
 * false en caso contrario.
 * 
 *
 * @param string $var
 * @param string $expresion
 * @param string $defecto
 * @return boolean
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool{

    //La función preg_match en PHP se utiliza para realizar coincidencias de patrones en cadenas.
    if (preg_match($expresion, $var)){
        return true;
    }

    //si no esta bien, hacemos cambio con el defecto y devolvemos false 
    $var=$defecto;
    return false;
}

/**
 * function validaRango(mixed $var, array $posibles, int $tipo=1):bool Esta función comprueba
 * que $var sea igual a uno de los elementos del array $posibles ($tipo=1) o a una de las claves
 * del array $posibles ($tipo=2). La función devuelve true si es correcta y false en caso contrario.
 *
 * @param mixed $var
 * @param  $posibles
 * @param  $tipo
 * @return boolean
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool{
    //si el array es de elementos es de tipo 1 p de claves de tipo 2 devolvemos
    if ($tipo === 1) {
        return in_array($var, $posibles, true);
    }

    if ($tipo === 2) {
        return array_key_exists($var, $posibles);
    }

    //si no devolvemos false directamente
    return false;
}