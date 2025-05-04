<?php
if (isset($_GET['search'])) $items = $order->searchOrder($_GET['search']);
else $items = $order->getAllOrder();

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $order->deleteOrder($_GET['id']);
    header("Location: ?page=order");
    exit;
}

if (isset($_POST['add_order'])) {
    $harga = (int) str_replace('Rp', '', $_POST['new_harga']);
    $order->addOrder($_POST['new_menu_IDs'], $_POST['new_karyawan_ID'], $harga);
    header("Location: ?page=order");
    exit;
}

if (isset($_POST['update_order'])) {
    $harga = (int) str_replace('Rp', '', $_POST['edit_harga']);
    $order->updateOrder($_POST['edit_id'], $_POST['edit_karyawan_ID'], $_POST['edit_menu_IDs'], $harga);
    header("Location: ?page=order");
    exit;
}
?>

<div>
    <div class="text-xl font-bold mb-4">Order List</div>
    <div class="flex justify-between mb-4">
        <a href="?page=order_form" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Order</a>
        <form action="?search=" method="get" class="flex gap-2">
            <input type="hidden" name="page" value="order">
            <input type="text" name="search" placeholder="Search..." class="border border-gray-300 rounded-md px-4 py-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
        </form>
    </div>
    <table class="w-full bg-white rounded-lg shadow-md border-separate"
        style="border-collapse: collapse;" id="table_container"
    >
        <thead>
            <tr>
                <th class="py-2 px-4 w-[50px] border-r border-gray-300">ID</th>
                <th class="py-2 px-4 w-auto border-r border-gray-300">Waktu</th>
                <th class="py-2 px-4 w-auto border-r border-gray-300">Karyawan</th>
                <th class="py-2 px-4 w-auto border-r border-gray-300">Menu</th>
                <th class="py-2 px-4 w-auto border-r border-gray-300">Total Harga</th>
                <th class="py-2 px-4 w-[190px]">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $num = 1; ?>
            <?php foreach ($items as $item): ?>
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-4 text-center w-[50px] border-r border-gray-300"><?php echo $num++; ?></td>
                    <td class="py-2 px-4 text-center w-auto border-r border-gray-300"><?php echo $item['waktu']; ?></td>
                    <td class="py-2 px-4 text-center w-auto border-r border-gray-300"><?php echo $item['karyawan']; ?></td>
                    <td class="py-2 px-4 w-auto border-r border-gray-300">
                        <?php foreach ($order->getAllMenuOrder($item['ID']) as $menu):
                                echo "<li>" . $menu['nama'] . "</li>";
                            endforeach;
                        ?>
                    </td>
                    <td class="py-2 px-4 w-auto border-r border-gray-300">Rp<?php echo number_format($item['harga']); ?></td>
                    <td class="py-2 px-4 w-[190] flex gap-2">
                        <a href="?page=order_form&id=<?php echo $item['ID']; ?>" class="w-[75px] text-center p-2 bg-blue-500 text-white rounded-md">Edit</a>
                        <a href="?page=order&action=delete&id=<?php echo $item['ID']; ?>" onclick="return confirm('Are you sure you want to delete this order?');" class="w-[75px] text-center p-2 bg-red-500 text-white rounded-md">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>