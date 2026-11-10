<?php 
include_once(RUTABASE."/scripts/librerias/validacion.php");

final class MuebleTradicional extends MuebleBase{

    /**
     * VARIABLES --> de peso y de serie 
     *
     * @var float
     * @var string
     */
    private float $_peso;
    private string $_serie;

    /**
     * __CONSTRUCT --> llamamos al constructor de la padrfe y le pasamos los dos parametros nuevos 
     *
     * @param string $nombre
     * @param string $fabricante
     * @param string $pais
     * @param int $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param float $precio
     * @param float $peso
     * @param string $serie
     */
    public function __construct(string $nombre,string $fabricante = "FaMu:",string $pais = "ESPAÑA",int $anio = 2020,
                                string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040",float $precio = 30,
                                float $peso = 15,string $serie = "S01"){

        
        parent::__construct($nombre,$fabricante,$pais,$anio,$fechaIniVenta,$fechaFinVenta,$precio);

        //llamamos al set dle peso y le pasamos el por defecto
        if(!$this->setPeso($peso)){
            $this->_peso = 15;
        }

        //llamamos al set de serie y le pasamos el pordefecto
        if(!$this->setSerie($serie)){
            $this->_serie = "S01";
        }
    }


    /**
     * GETTER'S AND SETTER'S --> de las variables nuevas
     */


    /**
     * metodo get que devuelve el peso
     *
     * @return float
     */
    public function getPeso(): float{
        return $this->_peso;
    }


    /**
     * Metodo set que asigna el peso 
     *
     * @param float $peso
     * @return bool
     */
    public function setPeso(float $peso): bool{

        //validamos el rango entre 15 y 300
        if(!validaRango($peso,[15,300])){
            return false;
        }

        //Asignamos 
        $this->_peso = $peso;
        return true;
    }


    /**
     * metodo getter que devuelve la serie
     *
     * @return string
     */
    public function getSerie(): string
    {
        return $this->_serie;
    }


    /**
     * metodo setter de serie que verifica 
     *
     * @param string $serie
     * @return bool
     */
    public function setSerie(string $serie): bool
    {

        if(trim($serie) == ""){
            return false;
        }

        //asignamos
        $this->_serie = $serie;
        return true;
    }


    /**
     * METODO ABSTRACTO --> heredado de la clase padre donde vamos añadir las dos variables nuevas 
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array{
        return ["Peso","Serie"];
    }


    /**
     * _TOSTRING 
     *
     * @return string
     */
    public function __toString(): string{

        return parent::__toString(). ", peso " . $this->_peso. ", serie " . $this->_serie;
   
    }


}