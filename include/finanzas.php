<?php

class Finanzas extends Db {
    function Total() {
        $data = $this->connect()->prepare("SELECT total FROM inventario");
        
        if($data->execute()){
            return $data->fetch(PDO::FETCH_ASSOC)['total'];
        }
        return 0;
    }
    function nuevaOperacion($Desc, $Monto) {
        
        $total = $this->Total() + $Monto;
        date_default_timezone_set('America/Panama');
        $querry = $this->connect()->prepare("INSERT INTO inventario (descripcion, montoOperacion, fecha, total) VALUES (:descripcion, :montoOperacion, :fecha, :total)");
        $data = [
            'descripcion' => htmlspecialchars($Desc),
            'montoOperacion' => htmlspecialchars($Monto),
            'fecha' => date('d-m-Y', time()),
            'total' => $total,
        ];
        if($querry->execute($data) != false){
            return true;
        }
        return false;
    }


    function verOperaciones() {
        $data = $this->connect()->prepare("SELECT * FROM inventario ORDER BY id DESC");
        if($data->execute()){
            $data = $data->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        return [];
    }
}
