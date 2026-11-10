<?php 
include_once(RUTABASE."/scripts/librerias/validacion.php");

final class MuebleReciclado extends MuebleBase{

    /**
     * VARIABLE --> porcentaje de material reciclado 
     *
     * @var integer
     */
    private int $_porcentajeReciclado;

    /**
     * __CONSTRUCT -->llamamos al padre y le pasamos el parametro nuevo 
     *
     * @param string $nombre
     * @param string $fabricante
     * @param string $pais
     * @param int $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param float $precio
     * @param int $porcentajeReciclado
     */
    public function __construct(string $nombre,string $fabricante = "FaMu:",string $pais = "ESPAÑA",int $anio = 2020,string $fechaIniVenta = "01/01/2020",
                                string $fechaFinVenta = "31/12/2040",float $precio = 30,int $porcentajeReciclado = 10){
        //llamamos al padre
        parent::__construct( $nombre, $fabricante,$pais,$anio,$fechaIniVenta,$fechaFinVenta,$precio);

        //pasamos el numero de porcentaje reciclado que tiene que estar por defecto a 10
        if(!$this->setPorcentajeReciclado($porcentajeReciclado)){
            $this->_porcentajeReciclado = 10;
        }
    }

    /**
     * GETTER'S AND SETTER'S --> de la variable nueva 
     */

    /**
     * Metodo get que devuelve el porcentaje 
     *
     * @return int
     */
    public function getPorcentajeReciclado(): int{
        return $this->_porcentajeReciclado;
    }

    /**
     * Metodo set que Asigna el porcentaje reciclado.
     *
     * Debe estar entre 0 y 100.
     *
     * @param int $porcentajeReciclado
     * @return bool
     */
    public function setPorcentajeReciclado(int $porcentajeReciclado): bool{
        //verifica que este entre 0 y 100
        if(!validaRango($porcentajeReciclado,[0,100])){
            return false;
        }

        //asignamos
        $this->_porcentajeReciclado = $porcentajeReciclado;
        return true;
    }

    /**
     * Devuelve las propiedades adicionales
     * respecto a MuebleBase.
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array{
        return ["_porcentajeReciclado"];
    }

    /**
     * METODO MAGICO _TOSTRING 
     *
     * @return string
     */
    public function __toString(): string{
        return parent::__toString(). ", porcentaje reciclado ". $this->_porcentajeReciclado . "%";
    }
}


