<?php

class Db {
    protected $dataFile = 'finanzas.json';

    public function getData() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            return json_decode($data, true);
        }
        return [];
    }

    public function saveData($data) {
        $json = json_encode($data);
        file_put_contents($this->dataFile, $json);
    }
}
