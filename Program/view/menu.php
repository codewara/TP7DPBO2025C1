<?php
if (isset($_GET['search'])) $items = $menu->searchMenu($_GET['search']);
else $items = $menu->getAllMenu();

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $menu->deleteMenu($_GET['id']);
    header("Location: ?page=menu");
    exit;
}

if (isset($_POST['add_menu'])) {
    $menu->addMenu($_POST['new_menu'], $_POST['new_kategori_ID'], $_POST['new_harga']);
    header("Location: ?page=menu");
    exit;
}

if (isset($_POST['update_menu'])) {
    $menu->updateMenu($_POST['edit_id'], $_POST['edit_menu'], $_POST['edit_kategori_ID'], $_POST['edit_harga']);
    header("Location: ?page=menu");
    exit;
}
?>

<div>
    <div class="text-xl font-bold mb-4">Menu List</div>
    <div class="flex justify-between mb-4">
        <a href="?page=menu_form" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Menu</a>
        <form action="?search=" method="get" class="flex gap-2">
            <input type="hidden" name="page" value="menu">
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
            <th class="py-2 px-4 w-auto border-r border-gray-300">Menu</th>
            <th class="py-2 px-4 w-auto border-r border-gray-300">Kategori</th>
            <th class="py-2 px-4 w-auto border-r border-gray-300">Harga</th>
            <th class="py-2 px-4 w-[190px]">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $num = 1; ?>
        <?php foreach ($items as $item): ?>
            <tr>
                <td class="py-2 px-4 text-center w-[50px] border-r border-gray-300"><?php echo $num++; ?></td>
                <td class="py-2 px-4 w-auto border-r border-gray-300"><?php echo $item['menu']; ?></td>
                <td class="py-2 px-4 text-center w-auto border-r border-gray-300"><?php echo $item['kategori']; ?></td>
                <td class="py-2 px-4 w-auto border-r border-gray-300">Rp<?php echo number_format($item['harga']); ?></td>
                <td class="py-2 px-4 w-[190] flex gap-2">
                    <a href="?page=menu_form&id=<?php echo $item['ID']; ?>" class="w-[75px] text-center p-2 bg-blue-500 text-white rounded-md">Edit</a>
                    <a href="?page=menu&action=delete&id=<?php echo $item['ID']; ?>" onclick="return confirm('Are you sure you want to delete this menu?');" class="w-[75px] text-center p-2 bg-red-500 text-white rounded-md">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>