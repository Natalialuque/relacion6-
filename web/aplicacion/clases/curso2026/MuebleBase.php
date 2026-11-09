<?php
 abstract class MuebleBase{
    /**
     * VARIABLES
     */
    //constante
    public const MAXIMO_MUEBLES = 100;
    //variable privada de clase
    private static int $_mueblesCreados = 0;
    // Propiedades de instancia
    private string $_nombre;
    private string $_fabricante;
    private string $_pais;
    private int $_anio;
    private string $_fechaIniVenta;
    private string $_fechaFinVenta;
    private float $_precio;

    /**
     * 
     * METODOS GETTER´S Y SETER'S 
     * En los setter vamos a realizar las verificaciones de los campos porque nos lo pide el ejercicio 
     * 
     */

    /**
     * Metodo get para poder llamar al nombre
     * @return string
     */
    public function getNombre():string{
        return $this->_nombre;
    }

    /**
     * cadena de máximo 40, no puede estar vacía, a mayúscula,obligatorio
     *
     * @param string $nombre
     * @return boolean
     */
    public function setNombre(string $nombre):bool{
       
        //cadena maxima de 40
        if(!validaCadena($nombre,40)){
            return false;
        }
        //no puede estar vacio 
        if(trim($nombre)==""){
            return false;
        }
        //lo ponemos a mayuscula obligatoriamente
        $this -> _nombre=mb_strtoupper($nombre);;
        return true;
    }

    /**
     * Metodo get para poder llamar al nombre
     * @return string
     */
    public function getFabricante():string{
        return $this->_fabricante;
    }

    /**
     * (cadena de máximo 30, por defecto ‘FaMu:’, siempre se añade al principio FaMu: si no lo tiene ya - se recorta a 30 caracteres-),
     *
     * @param string $fabricante
     * @return boolean
     */
    public function setFabricante(string $fabricante):bool{

        //debe de empezar por FaMu:
        if(!str_starts_with($fabricante,"FaMu:")){
            $fabricante = "FaMu:". $fabricante;
        }

        //añade al principio FaMu: si no lo tiene ya y se recorta a 30 caracteres.
        $fabricante = mb_substr($fabricante,0,30);
        
        //asignamos
        $this -> _fabricante=$fabricante;
        return true;
    }


}