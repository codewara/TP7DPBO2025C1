<?php
require_once 'config.php';

class Menu {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function addMenu($nama, $kategori_ID, $harga) {
        $stmt = $this->db->prepare("INSERT INTO menu (nama, kategori_ID, harga) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $kategori_ID, $harga]);
    }
    
    public function getAllMenu() {
        $stmt = $this->db->query("SELECT m.ID, m.nama as menu, k.nama as kategori, m.harga
                                  FROM menu m
                                  INNER JOIN kategori k ON m.kategori_ID = k.ID");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuByID($id) {
        $stmt = $this->db->prepare("SELECT * FROM menu WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllKategori() {
        $stmt = $this->db->query("SELECT * FROM kategori");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateMenu($id, $nama, $kategori_ID, $harga) {
        $stmt = $this->db->prepare("UPDATE menu SET nama = ?, kategori_ID = ?, harga = ? WHERE ID = ?");
        return $stmt->execute([$nama, $kategori_ID, $harga, $id]);
    }

    public function deleteMenu($id) {
        $stmt = $this->db->prepare("DELETE FROM menu WHERE ID = ?");
        return $stmt->execute([$id]);
    }

    public function searchMenu($search) {
        $stmt = $this->db->prepare("SELECT m.ID, m.nama as menu, k.nama as kategori, m.harga
                                     FROM menu m
                                     INNER JOIN kategori k ON m.kategori_ID = k.ID
                                     WHERE m.nama LIKE ? OR k.nama LIKE ?");
        $stmt->execute(["%$search%", "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>