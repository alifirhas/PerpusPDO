<?php

class Buku extends Connection{

    public function index(){
        $sql = "SELECT * FROM buku";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    public function store($judul, $pengarang, $stok){
        
        $sql = "INSERT INTO buku (judul,pengarang,stok) value (:judul,:pengarang,:stok)";
        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":judul", $judul, PDO::PARAM_STR);
        $stmt->bindValue(":pengarang", $pengarang, PDO::PARAM_STR);
        $stmt->bindValue(":stok", intval($stok), PDO::PARAM_INT);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;

        }

        echo "Berhasil ditambahkan";
        return true;

    }

    public function destroy($id){
        
        $sql = "DELETE FROM buku where id=:id";
        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        }

        echo "Berhasil dihapus";
        return true;

    }

    public function getBuku($id){
        $sql = "SELECT * FROM buku where id=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]); 
        return $stmt->fetch();
        
    }

    public function update($id, $judul, $pengarang, $stok){
        
        $sql = "UPDATE buku set 
            judul=:judul,
            pengarang=:pengarang,
            stok=:stok 
            where id=:id";

        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":judul", $judul, PDO::PARAM_STR);
        $stmt->bindValue(":pengarang", $pengarang, PDO::PARAM_STR);
        $stmt->bindValue(":stok", intval($stok), PDO::PARAM_INT);
        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);

        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;
        }

        return true;

    }
    
}