<?php

class Transaksi extends Connection{

    public function index(){
        $sql = "SELECT transaksi.*, anggota.nama AS anggota, buku.judul AS buku FROM `transaksi` 
            INNER JOIN anggota ON transaksi.anggota_id = anggota.id 
            INNER JOIN buku ON transaksi.buku_id = buku.id
            order by transaksi.id desc";

        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    public function store($anggota, $buku, $tglPinjam, $tglKembali){
        
        $sql = "INSERT INTO transaksi (anggota_id, buku_id, tgl_pinjam, tgl_kembali) 
            value (:anggota, :buku, :tglPinjam, :tglKembali)";

        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":anggota", $anggota, PDO::PARAM_STR);
        $stmt->bindValue(":buku", $buku, PDO::PARAM_STR);
        $stmt->bindValue(":tglPinjam", $tglPinjam, PDO::PARAM_STR);
        $stmt->bindValue(":tglKembali", $tglKembali, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;
        }

        echo "Berhasil ditambahkan";
        return true;

    }

    public function destroy($id){
        
        $sql = "DELETE FROM transaksi where id=:id";
        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        }

        echo "Berhasil dihapus";
        return true;

    }

    public function update($id){
        
        $sql = "UPDATE transaksi set 
            status='1'
            where id=:id";

        $stmt = $this->connect()->prepare($sql);//statement

        $stmt->bindValue(":id", strval($id), PDO::PARAM_STR);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return false;
        }

        return true;

    }
    
}