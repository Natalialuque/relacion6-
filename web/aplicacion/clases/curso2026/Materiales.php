<?php 
/**
 * Clases enum que guarda los 4 valores de materiales 
 */
enum Materiales : int{
    /**
     * 4 materiales nuevos de la enum
     */
    case madera=5;
    case hierro =10;
    case plastico=15;
    case metal=20;

   /**
     * METODO DESCRIPCION -->devuelve el nombre del caso en concreto
     * @return string
     */
    function descripcion (): string{
        return $this -> name; //este name contiene el nombre del caso (madera,hierro,plastico...)
    }

    /**
     * METODO VALOR --> devuelve el valor de un caso en concreto
     * @return integer
     */
    function valor (): int{
        return $this -> value; //este value contiene el valor de cada caso (madera,hierro,plastico...)
    }

     /**
     * METODO ESTATICO --> devuelve un array con todos los casos
     * @return array
     */
    static function casos():array{
        return self::cases(); //esto devuelve el objeto tal cual de arrays
    }

}