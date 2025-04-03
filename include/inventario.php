<?php
const ValorLeche = 3000;
const ValorGramoLecherita = 10.77;
const ValorCremaLeche = 2000;
const ValorGramoGelatina = 0;
const ValorPaquetato = 1000;
const ValorEnvases = 330;
const ValorCucharas = 25.5;
const ValorGorro = 0;
const ValorCubreBocas = 0;
const ValorGuantes = 0;

class inventario extends Db{


    function nuevaOperacion($_array) {
        $data = $this->getData();

        date_default_timezone_set('America/Panama');
        $id = $this->generateUniqueId($data);
        $data[] = [
            'id' => $id,
            'Leche' => htmlspecialchars($_array['Leche']),
            'Lecherita' => htmlspecialchars($_array['Lecherita']),
            'C.Leche' => htmlspecialchars($_array['C.Leche']),
            'Paquetatos' => htmlspecialchars($_array['Paquetatos']),
            'Gelatina' => htmlspecialchars($_array['Gelatina']),
            'Envase' => htmlspecialchars($_array['Envase']),
            'Gorros' => htmlspecialchars($_array['Gorros']),
            'CubreBocas' => htmlspecialchars($_array['CubreBocas']),
            'Cucharas' => htmlspecialchars($_array['Cucharas']),
            'Guantes' => htmlspecialchars($_array['Guantes']),
            'Fecha' => date('d-m-Y', time()),
        ];

        $this->saveData($data);
        return true;
    }
    function verOperaciones() {
        $data = $this->getData();

        // Ordenar las operaciones por id de manera descendente
        usort($data, function($a, $b) {
            return $b['id'] - $a['id'];
        });

        return $data;
    }
    function valuesForm(){
        $data = $this->verOperaciones()[0];
        $_array = [
            'Leche' => ($data['Leche'] != 0 ) ? 'value="'.$data['Leche'].'"' : 'value=""',
            'Lecherita' => ($data['Lecherita'] != 0 ) ? 'value="'.$data['Lecherita'].'"' : 'value=""',
            'C.Leche' => ($data['C.Leche'] != 0 ) ? 'value="'.$data['C.Leche'].'"' : 0,
            'Paquetatos' => ($data['Paquetatos'] != 0 ) ? 'value="'.$data['Paquetatos'].'"' : 'value=""',
            'Gelatina' => ($data['Gelatina'] != 0) ? 'value="'.$data['Gelatina'].'"' : 'value=""',
            'Envase' => ($data['Envase'] != 0) ? 'value="'.$data['Envase'].'"' : 'value=""',
            'Gorros' => ($data['Gorros'] != 0) ? 'value="'.$data['Gorros'].'"' : 'value=""',
            'CubreBocas' => ($data['CubreBocas'] != 0) ? 'value="'.$data['CubreBocas'].'"' : 'value=""',
            'Cucharas' => ($data['CubreBocas'] != 0) ? 'value="'.$data['Cucharas'].'"' : 'value=""',
            'Guantes' => ($data['Guantes'] != 0) ? 'value="'.$data['Guantes'].'"' : 'value=""',
        ];
        return $_array;
    }
    function invValor(){
        $Values = $this->verOperaciones()[0];
        $total_inv = 0;

        $total_inv += $Values['Leche']*ValorLeche;
        $total_inv += $Values['Lecherita']*ValorGramoLecherita;
        $total_inv += $Values['C.Leche']*ValorCremaLeche;
        $total_inv += $Values['Paquetatos']*ValorPaquetato;
        $total_inv += $Values['Gelatina']*ValorGramoGelatina;
        $total_inv += $Values['Envase']*ValorEnvases;
        $total_inv += $Values['Gorros']*ValorGorro;
        $total_inv += $Values['CubreBocas']*ValorCubreBocas;
        $total_inv += $Values['Cucharas']*ValorCucharas;
        $total_inv += $Values['Guantes']*ValorGuantes;

        return $total_inv;
    }
    private function generateUniqueId($data) {
        if (!empty($data)) {
            $ids = array_column($data, 'id');
            return max($ids) + 1;
        } else {
            return 1; // Si no hay elementos, comenzamos desde 1.
        }
    }
}