<?php
require_once 'config.php';

class Member {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function addKaryawan($nama, $posisi) {
        $stmt = $this->db->prepare("INSERT INTO karyawan (nama, posisi) VALUES (?, ?)");
        return $stmt->execute([$nama, $posisi]);
    }

    public function getAllKaryawan() {
        $stmt = $this->db->query("SELECT * FROM karyawan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKaryawanByID($id) {
        $stmt = $this->db->prepare("SELECT * FROM karyawan WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateKaryawan($id, $nama, $posisi) {
        $stmt = $this->db->prepare("UPDATE karyawan SET nama = ?, posisi = ? WHERE ID = ?");
        return $stmt->execute([$nama, $posisi, $id]);
    }

    public function deleteKaryawan($id) {
        $stmt = $this->db->prepare("DELETE FROM karyawan WHERE ID = ?");
        return $stmt->execute([$id]);
    }

    public function searchKaryawan($search) {
        $stmt = $this->db->prepare("SELECT * FROM karyawan WHERE nama LIKE ? OR posisi LIKE ?");
        $stmt->execute(["%$search%", "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>