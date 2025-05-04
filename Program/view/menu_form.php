<?php
if (isset($_GET['id'])) {
    $update = $menu->getMenuByID($_GET['id']);
    $opt = "edit";
    $send = "update";
} else {
    $opt = "new";
    $send = "add";
}
$kategori = $menu->getAllKategori();
?>

<div>
    <div class="text-xl font-bold mb-4">Add Menu</div>
    <form action="?page=menu" method="post" class="flex flex-col gap-4">
        <input type="hidden" name="<?=$opt . "_id"?>" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>">
        <div class="flex flex-col gap-2">
            <label for="menu" class="text-gray-700">Menu</label>
            <input type="text" name="<?=$opt . "_menu"?>" id="menu" required class="border border-gray-300 rounded-md px-4 py-2"
            <?php if (isset($_GET['id'])) echo "value='" . $update['nama'] . "'"; ?>>
        </div>
        <div class="flex flex-col gap-2">
            <label for="kategori" class="text-gray-700">Kategori</label>
            <select name="<?=$opt . "_kategori_ID"?>" id="kategori" required class="border border-gray-300 rounded-md px-4 py-2">
                <option value="">Select Kategori</option>
                <?php foreach ($kategori as $item): ?>
                    <option value="<?php echo $item['ID']; ?>"<?php if (isset($_GET['id']) && $item['ID'] == $_GET['id']) echo "selected"; ?>
                    ><?php echo $item['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex flex-col gap-2">
            <label for="harga" class="text-gray-700">Harga</label>
            <input type="number" name="<?=$opt . "_harga"?>" id="harga" required class="border border-gray-300 rounded-md px-4 py-2"
            <?php if (isset($_GET['id'])) echo "value='" . $update['harga'] . "'"; ?>>
        </div>
        <button type="submit" name="<?=$send . "_menu"?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            <?php if (isset($_GET['id'])) echo "Update"; else echo "Add"; ?> Menu
        </button>
    </form>
</div>
