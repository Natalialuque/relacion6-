<?php
include_once(RUTABASE."/scripts/librerias/validacion.php");

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
    * __CONSTRUCT --> Pasamos todos los valores teniendo en cuenta que devolveremos errores si algo no funciona y que usaremos los metodos set para asignar los valores
    *
    * @param string $nombre
    * @param string $fabricante
    * @param string $pais
    * @param integer $anio
    * @param string $fechaIniVenta
    * @param string $fechaFinVenta
    * @param integer $precio
    */
    public function __construct(string $nombre,string $fabricante = "FaMu:",string $pais = "ESPAÑA",
                                int $anio = 2020,string $fechaIniVenta = "01/01/2020",
                                string $fechaFinVenta = "31/12/2040",float $precio = 30)
    {
        //no se pueden crear más muebles
        if (self::$_mueblesCreados >= self::MAXIMO_MUEBLES) {
            throw new Exception("Se ha alcanzado el máximo de muebles");
        }

        //nombre obligatorio
        if (!$this->setNombre($nombre)) {
            throw new Exception("Nombre incorrecto");
        }

        //fabricante
        if (!$this->setFabricante($fabricante)) {
            $this->_fabricante = "FaMu:";
        }

        //pais
        if (!$this->setPais($pais)) {
            $this->_pais = "ESPAÑA";
        }

        //anio
        if (!$this->setAnio($anio)) {
            $this->_anio = 2020;
        }

        //fecha inicio
        if (!$this->setFechaIniVenta($fechaIniVenta)) {
            $this->_fechaIniVenta = "01/01/" . $this->_anio;
        }

        //fecha fin
        if (!$this->setFechaFinVenta($fechaFinVenta)) {
            $this->_fechaFinVenta = "31/12/2040";
        }

        //precio
        if (!$this->setPrecio($precio)) {
            $this->_precio = 30;
        }

        self::$_mueblesCreados++;
    }

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
     * Metodo set para nombre --> cadena de máximo 40, no puede estar vacía, a mayúscula,obligatorio
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
     * Metodo get para poder llamar al fabricante
     * @return string
     */
    public function getFabricante():string{
        return $this->_fabricante;
    }

    /**
     * Metodo set para fabricante -->cadena de máximo 30, por defecto ‘FaMu:’, siempre se añade al principio FaMu: si no lo tiene ya - se recorta a 30 caracteres-),
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

    /**
     * Metodo get para poder llamar al pais
     * @return string
     */
    public function getPais():string{
        return $this->_pais;
    }

    /**
     * Metodo set para pais -->cadena, máximo 20 caracteres, por defecto ‘ESPAÑA’(ESTO SE METE EN EL CONSTRUCTOR)
     *
     * @param string $pais
     * @return boolean
     */
    public function setPais(string $pais):bool{
        //validamos cadena y que tenga 20
        if(!validaCadena($pais,20)){
            return false;
        }

        //asignamos
        $this->_pais = $pais;
        return true;
    }

    /**
     * Metodo get para poder llamar al Anio
     * @return int
     */
    public function getAnio():int{
        return $this->_anio;
    }

    /**
     * Metodo set para año -->Entero, año de inicio de fabricación, valor entre 2020 y el año actual, por defecto 2020 ( ESTO SE METE EN EL CONSTRUCOTR)
     *
     * @param int $anio
     * @return boolean
     */
    public function setAnio(int $anio): bool{
        //para sacar el año actual
        $anioActual = (int)date("Y");
        //verificamos
        if ($anio < 2020 || $anio > $anioActual) {
            return false;
        }

        //asignamos
        $this->_anio = $anio;
        return true;
    }

    /**
     * Metodo get para poder llamar al fechaIniVenta
     * @return string
     */
    public function getFechaIniVenta(): string{
        return $this->_fechaIniVenta;
    }

    /**
     * Metodo set para fechaIni --> cadena, fecha en la que se empieza a vender el mueble, no puede ser anterior al uno de enero del Anio de inicio
     * de fabricación, en caso de fallo se asigna “01/01/anio”, por defecto ‘01/01/2020’ aunque
     * se usará lo anterior (ESTE POR DEFECTO VA AL CONSTRUCTOR )
     *
     * @param string $fecha
     * @return boolean
     */
    public function setFechaIniVenta(string $fecha): bool{

        //validamos la fecha 
        if (!validaFecha($fecha, "01/01/" . $this->_anio)) {
            return false;
        }

        //que las fechas no se pisen 
        $fechaMinima = DateTime::createFromFormat("d/m/Y","01/01/" . $this->_anio);
        $fechaVenta = DateTime::createFromFormat("d/m/Y",$fecha);

        if ($fechaVenta < $fechaMinima) {
            return false;
        }

        //Asignamos
        $this->_fechaIniVenta = $fecha;
        return true;
    }

     /**
     * Metodo get para poder llamar al fechaIniVenta
     * @return string
     */
    public function getFechaFinVenta(): string{
        return $this->_fechaFinVenta;
    }

    /**
     * Metodo set para fechaFin -->cadena-fecha, fecha en la que dejará de venderse,
     * no puede ser anterior a la FechaIniVenta, por defecto 31/12/2040’) y Precio (real, por
     * defecto 30, no puede ser menor de 30). (EL DEFECTO AL CONSTRUCOTR)
     *
     * @param string $fecha
     * @return boolean
     */
    public function setFechaFinVenta(string $fecha): bool{

        //verificamos con el valida 
        if (!validaFecha($fecha, "31/12/2040")) {
            return false;
        }

        $fechaFin = DateTime::createFromFormat("d/m/Y",$fecha);
        $fechaInicio = DateTime::createFromFormat("d/m/Y",$this->_fechaIniVenta);

        if ($fechaFin < $fechaInicio) {
            return false;
        }

        //Asignamos
        $this->_fechaFinVenta = $fecha;
        return true;
    }

    /**
     * Metodo get para poder llamar al precio
     * @return float
     */
    public function getPrecio(): float{
        return $this->_precio;
    }

    /**
     * Metodo set para precio -->real, por defecto 30, no puede ser menor de 30).
     *
     * @param float $precio
     * @return boolean
     */
    public function setPrecio(float $precio): bool{

        //que el precio no sea menor
        if ($precio < 30) {
            return false;
        }

        //Asignamos
        $this->_precio = $precio;
        return true;
    }


    /**
     * SOBRECARGA DINAMICA --> La desahibilitamos
      * @return void
     * @return mixed
     * @return bool
     * @return void
     */
    public function __set(string $name, mixed $value): void{
        throw new Exception("No existe la propiedad $name");
    }

    public function __get(string $name): mixed{
        throw new Exception("No existe la propiedad $name");
    }

    public function __isset(string $name): bool{
        return false;
    }

    public function __unset(string $name): void{
        throw new Exception("No existe la propiedad $name");
    }

    /**
     * METODO ABSTRACTO --> damePropiedadesAdicionales. Este metodo podra ser redefinido en las clases hijas y devolverá 
     * un array con el nombre de las propiedades adicionales a la clase base
     *
     * @return array
     */
    abstract public function damePropiedadesAdicionales(): array;

    /**
     * METODO DE CLASE --> puedeCrear que devuelve true si se pueden crear más instancias de la
     * clase y false en caso contrario. Además, devuelve en el parámetro Número el número de
     * muebles que aún se pueden crear de la clase.
     *
     * @param integer $numero
     * @return boolean
     */
    public static function puedeCrear(int &$numero): bool {
        $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;

        if($numero > 0){
            return true;
        }
        return false;
    }

    /**
     * METODO MAGICO _TOSTRING --> Método que al convertir la instancia en cadena nos devuelve 'MUEBLE de clase
     * XXX con nombre XXX, fabricante XXX, fabricado en XXX a partir del año 999,
     * vendido desde 99/99/9999 hasta 99/99/9999, precio 9999'
     */
    public function __toString(): string{
        
        return "MUEBLE de clase ".get_class($this)." con nombre ".$this->_nombre.", fabricante ".$this->_fabricante.
            ", fabricado en ".$this->_pais." a partir del año ".$this->_anio.", vendido desde ".$this->_fechaIniVenta.
            " hasta ".$this->_fechaFinVenta.", precio ".$this->_precio;
    }
}