<?php

class Anggota extends Connection{

    public function index(){
        $sql = "SELECT * FROM anggota";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    public function store($nama){
        
        $sql = "INSERT INTO anggota (nama) value (:nama)";
        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":nama", $nama, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;
        }

        echo "Berhasil ditambahkan";
        return true;

    }

    public function destroy($id){
        
        $sql = "DELETE FROM anggota where id=:id";
        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        }

        echo "Berhasil dihapus";
        return true;

    }

    public function getAnggota($id){
        $sql = "SELECT * FROM anggota where id=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]); 
        return $stmt->fetch();
        
    }

    public function update($id, $nama){
        
        $sql = "UPDATE anggota set 
            nama=:nama
            where id=:id";

        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":nama", $nama, PDO::PARAM_STR);
        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);

        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;
        }

        return true;

    }
    
}