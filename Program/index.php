<?php
require_once 'class/Menu.php';
require_once 'class/Karyawan.php';
require_once 'class/Order.php';

$menu = new Menu();
$karyawan = new Member();
$order = new Order();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopisyop</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body class="bg-gray-100">
    <?php include 'view/header.php'; ?>
    <main class="mx-24 mb-8 mt-4 my-8 min-h-[70.3vh]">
        <div class="text-2xl font-bold mb-8">Welcome to Kopisyop</div>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            include "view/$page.php";
        }
        ?>
    </main>
    <?php include 'view/footer.php'; ?>
</body>
</html>