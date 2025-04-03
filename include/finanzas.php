<?php

class Finanzas extends Db {
    function nuevaOperacion($Desc, $Monto) {
        $data = $this->getData();
        
        $total = $this->Total() + $Monto;
        date_default_timezone_set('America/Panama');
        $id = $this->generateUniqueId($data);
        $data[] = [
            'id' => $id,
            'Desc' => htmlspecialchars($Desc),
            'MontoOperación' => htmlspecialchars($Monto),
            'Fecha' => date('d-m-Y', time()),
            'TotalDulces' => $total,
        ];

        $this->saveData($data);
        return true;
    }

    function Total() {
        $data = $this->getData();

        if (!empty($data)) {
            $lastEntry = end($data);
            return $lastEntry['TotalDulces'];
        }

        return 0;
    }

    function verOperaciones() {
        $data = $this->getData();

        // Ordenar las operaciones por id de manera descendente
        usort($data, function($a, $b) {
            return $b['id'] - $a['id'];
        });

        return $data;
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
