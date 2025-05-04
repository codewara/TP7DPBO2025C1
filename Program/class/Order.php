<?php
require_once 'config.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function addOrder($menu_IDs, $karyawan_ID, $harga) {
        $stmt = $this->db->prepare("INSERT INTO `order` (waktu, karyawan_ID, harga) VALUES (?, ?, ?)");
        $stmt->execute([date("Y-m-d H:i:s"), $karyawan_ID, $harga]);
        $id = $this->db->lastInsertId();

        foreach ($menu_IDs as $menu) {
            $stmt = $this->db->prepare("INSERT INTO order_menu (order_ID, menu_ID) VALUES (?, ?)");
            $stmt->execute([$id, $menu]);
        }
    }

    public function getAllOrder() {
        $stmt = $this->db->query("SELECT o.ID, o.waktu, k.nama as karyawan, o.harga
                                  FROM `order` o
                                  INNER JOIN karyawan k ON o.karyawan_ID = k.ID");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderByID($id) {
        $stmt = $this->db->prepare("SELECT o.ID, o.waktu, k.ID as karyawan_ID, k.nama as karyawan, o.harga
                                    FROM `order` o
                                    INNER JOIN karyawan k ON o.karyawan_ID = k.ID
                                    WHERE o.ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllMenuOrder($id) {
        $stmt = $this->db->prepare("SELECT om.menu_ID, m.nama
                                    FROM `order` o
                                    INNER JOIN order_menu om ON o.ID = om.order_ID
                                    INNER JOIN menu m ON om.menu_ID = m.ID
                                    WHERE o.ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrder($id, $karyawan_ID, $menu_IDs, $harga) {
        $stmt = $this->db->prepare("DELETE FROM order_menu WHERE order_ID = ?");
        $stmt->execute([$id]);

        foreach ($menu_IDs as $menu) {
            $stmt = $this->db->prepare("INSERT INTO order_menu (order_ID, menu_ID) VALUES (?, ?)");
            $stmt->execute([$id, $menu]);
        }
        $stmt = $this->db->prepare("UPDATE `order` SET waktu = ?, karyawan_ID = ?, harga = ? WHERE ID = ?");
        return $stmt->execute([date("Y-m-d H:i:s"), $karyawan_ID, $harga, $id]);
    }

    public function deleteOrder($id) {
        $stmt = $this->db->prepare("DELETE FROM order_menu WHERE order_ID = ?");
        $stmt->execute([$id]);
        $stmt = $this->db->prepare("DELETE FROM `order` WHERE ID = ?");
        return $stmt->execute([$id]);
    }

    public function searchOrder($search) {
        $stmt = $this->db->prepare("SELECT o.ID, o.waktu, k.nama as karyawan, m.nama as menu, o.harga
                                    FROM `order` o
                                    INNER JOIN karyawan k ON o.karyawan_ID = k.ID
                                    INNER JOIN order_menu om ON o.ID = om.order_ID
                                    INNER JOIN menu m ON om.menu_ID = m.ID
                                    WHERE k.nama LIKE ? OR m.nama LIKE ?");
        $stmt->execute(["%$search%", "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>