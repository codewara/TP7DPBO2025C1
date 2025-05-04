<?php
if (isset($_GET['id'])) {
    $update = $karyawan->getKaryawanByID($_GET['id']);
    $opt = "edit";
    $send = "update";
} else {
    $opt = "new";
    $send = "add";
}
?>

<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="text-xl font-bold mb-4">Add Karyawan</div>
    <form action="?page=karyawan" method="post" class="flex flex-col gap-4">
        <input type="hidden" name="<?=$opt . "_id"?>" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>">
        <div class="flex flex-col gap-2">
            <label for="nama" class="text-gray-700">Nama Karyawan</label>
            <input type="text" name="<?=$opt . "_karyawan"?>" id="nama" required class="border border-gray-300 rounded-md px-4 py-2"
            <?php if (isset($_GET['id'])) echo "value='" . $update['nama'] . "'"; ?>>
        </div>
        <div class="flex flex-col gap-2">
            <label for="posisi" class="text-gray-700">Posisi</label>
            <input type="text" name="<?=$opt . "_posisi"?>" id="posisi" required class="border border-gray-300 rounded-md px-4 py-2"
            <?php if (isset($_GET['id'])) echo "value='" . $update['posisi'] . "'"; ?>>
        </div>
        <button type="submit" name="<?=$send . "_karyawan"?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            <?php if (isset($_GET['id'])) echo "Update"; else echo "Add"; ?> Karyawan
        </button>
    </form>
</div>