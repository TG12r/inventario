<?php
const ValorLeche = 2700;
const ValorGramoLecherita = 11.96;
const ValorCremaLeche = 2200;
const ValorGramoGelatina = 0.0136;
const ValorPaquetato = 1000;
const ValorEnvases = 490;
const ValorCucharas = 25.5;
const ValorGorro = 0;
const ValorCubreBocas = 0;
const ValorGuantes = 0;

class inventario extends Db{


    function nuevaOperacion($_array) {

        date_default_timezone_set('America/Panama');
        $data = [
            'Leche' => htmlspecialchars($_array['Leche']),
            'Lecherita' => htmlspecialchars($_array['Lecherita']),
            'CLeche' => htmlspecialchars($_array['C.Leche']),
            'Paquetatos' => htmlspecialchars($_array['Paquetatos']),
            'Gelatina' => htmlspecialchars($_array['Gelatina']),
            'Envase' => htmlspecialchars($_array['Envase']),
            'Gorros' => htmlspecialchars($_array['Gorros']),
            'CubreBocas' => htmlspecialchars($_array['CubreBocas']),
            'Cucharas' => htmlspecialchars($_array['Cucharas']),
            'Guantes' => htmlspecialchars($_array['Guantes']),
            'Fecha' => date('d-m-Y', time()),
        ];
        $querry = $this->connect()->prepare("INSERT INTO invDb (leche, Lecherita, CLeche, Paquetatos, Gelatina, Envases, Gorros, CubreBocas, Cucharas, Guantes, Fecha) VALUES (:Leche, :Lecherita, :CLeche, :Paquetatos, :Gelatina, :Envase, :Gorros, :CubreBocas, :Cucharas, :Guantes, :Fecha)");
        if($querry->execute($data)){
            return true;
        }
        return false;
    }
    function verOperaciones() {
        $data = $this->connect()->prepare("SELECT * FROM invDb ORDER BY id DESC");
        if($data->execute()){
            $data = $data->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        return [];
    }
    function valuesForm(){
        $data = $this->verOperaciones()[0];
        $_array = [
            'Leche' => ($data['leche'] != 0 ) ? 'value="'.$data['leche'].'"' : 'value=""',
            'Lecherita' => ($data['Lecherita'] != 0 ) ? 'value="'.$data['Lecherita'].'"' : 'value=""',
            'C.Leche' => ($data['CLeche'] != 0 ) ? 'value="'.$data['CLeche'].'"' : 0,
            'Paquetatos' => ($data['Paquetatos'] != 0 ) ? 'value="'.$data['Paquetatos'].'"' : 'value=""',
            'Gelatina' => ($data['Gelatina'] != 0) ? 'value="'.$data['Gelatina'].'"' : 'value=""',
            'Envase' => ($data['Envases'] != 0) ? 'value="'.$data['Envases'].'"' : 'value=""',
            'Gorros' => ($data['Gorros'] != 0) ? 'value="'.$data['Gorros'].'"' : 'value=""',
            'CubreBocas' => ($data['CubreBocas'] != 0) ? 'value="'.$data['CubreBocas'].'"' : 'value=""',
            'Cucharas' => ($data['Cucharas'] != 0) ? 'value="'.$data['Cucharas'].'"' : 'value=""',
            'Guantes' => ($data['Guantes'] != 0) ? 'value="'.$data['Guantes'].'"' : 'value=""',
        ];
        return $_array;
    }
    function invValor(){
        $Values = $this->verOperaciones()[0];
        $total_inv = 0;

        $total_inv += $Values['leche']*ValorLeche;
        $total_inv += $Values['Lecherita']*ValorGramoLecherita;
        $total_inv += $Values['CLeche']*ValorCremaLeche;
        $total_inv += $Values['Paquetatos']*ValorPaquetato;
        $total_inv += $Values['Gelatina']*ValorGramoGelatina;
        $total_inv += $Values['Envases']*ValorEnvases;
        $total_inv += $Values['Gorros']*ValorGorro;
        $total_inv += $Values['CubreBocas']*ValorCubreBocas;
        $total_inv += $Values['Cucharas']*ValorCucharas;
        $total_inv += $Values['Guantes']*ValorGuantes;

        return $total_inv;
    }
}