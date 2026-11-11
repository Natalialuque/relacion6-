<?php 

class Caracteristicas implements iterator{

    /**
     * VARIABLES --> Nos pide que las caracteristicas se creen de forma dinamica, por lo que tendremos un array para ir guardandolas
    * Tenemos otra variable con condicion especial y es que si esta es = "ultima" debe bloquearse la creacion de nuevas caracteristicas
    */
    private array $carac = [];
    private bool $bloqueado = false;
    // Array usado para recorrer en sentido inverso
    private array $iteracion = [];

    //Posición actual del iterador
    private int $posicion = 0;

    /**
     * GETTER'S Y SETTER'S--> es la forma que tenemos para crearlas dinamicamente 
     */

    /**
     * Get para leerlas
     * @param string $nombre
     * @return void
     */
    public function __get(string $nombre){
        if (!isset($this->carac[$nombre])) {
        
        throw new Exception("No existe la característica $nombre");
    }

    }


    /**
     * Set para crearlas
     * @param string $nombre
     * @param mixed $valor
     */
    public function __set(string $nombre, mixed $valor){
        // Si ya está bloqueado y la propiedad no existía
        if ($this->bloqueado &&
            !isset($this->carac[$nombre])){
            throw new Exception(
                "No se pueden añadir más características"
            );
        }

        //asignamos
        $this->carac[$nombre] = $valor;

        //ponemos a true si es ultima
        if ($nombre === "ULTIMA"){
            $this->bloqueado = true;
        }
    }

    /**
     * IMPLEMENTACIÓN DEL ITERATOR --> pueden ser recorridas en un foreach devolviendo las propiedades enorden inverso a como se incorporaron
     */
    public function rewind(): void{
        $this->iteracion = array_reverse($this->carac,
            true
        );

        $this->posicion = 0;
    }

    public function current(): mixed{
        $valores = array_values($this->iteracion);

        return $valores[$this->posicion];
    }

    public function key(): mixed{
        $claves = array_keys($this->iteracion);

        return $claves[$this->posicion];
    }

    public function next(): void{
        $this->posicion++;
    }

    public function valid(): bool{
        return $this->posicion < count($this->iteracion);
    }


    /**
     * METODO MAGICO TOSTRING --> devolverá una cadena de la forma car1:valor1;car2:valor2;......
     */
    public function __toString(): string{
        $texto = "";

       foreach ($this->carac as $clave => $valor) {

        if (is_bool($valor)) {
            $valor = $valor ? "true" : "false";
        }
            $texto .= "$clave:$valor;";
        }

        return trim($texto, ";");
    }
}
