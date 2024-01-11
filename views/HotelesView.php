<?php

class HotelesView {

    public function mostrarHoteles($hoteles) {
        foreach ($hoteles as $key => $hotel) {
            
           
            
            foreach ($hotel as $valor) {
                echo $valor . "<br>";
            }
            
            echo '<br>';
            
            
        }
    }
}
