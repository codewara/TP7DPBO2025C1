<?php
if (isset($_GET['id'])) {
    $update = $order->getOrderByID($_GET['id']);
    $menu_order = $order->getAllMenuOrder($_GET['id']);
    $opt = "edit";
    $send = "update";
} else {
    $opt = "new";
    $send = "add";
}
$menu_items = $menu->getAllMenu();
$karyawan_items = $karyawan->getAllKaryawan();
?>

<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="text-xl font-bold mb-4">Add Order</div>
    <form action="?page=order" method="post" class="flex flex-col gap-4">
        <input type="hidden" name="<?=$opt . "_id"?>" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>">
        <div class="flex flex-col gap-2">
            <label for="karyawan_ID" class="text-gray-700">Karyawan</label>
            <select name="<?=$opt . "_karyawan_ID"?>" id="karyawan_ID" required class="border border-gray-300 rounded-md px-4 py-2">
                <option value="" disabled selected>-- Select Karyawan --</option>
                <?php foreach ($karyawan_items as $item): ?>
                    <option value="<?php echo $item['ID']; ?>" <?php if (isset($_GET['id']) && $update['karyawan_ID'] == $item['ID']) echo "selected"; ?>><?php echo $item['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex flex-col gap-2" id="menus">
            <label for="menu_IDs" class="text-gray-700">Menu</label>
            <?php if (isset($_GET['id'])) {
                $menu_q = 0;
                foreach ($menu_order as $menu) { ?>
                    <div class="flex items-center gap-4 menu_<?= $menu_q ?>">
                        <select name="<?=$opt . "_menu_IDs[" . $menu_q . "]"?>" id="menu_IDs" required class="border border-gray-300 rounded-md px-4 py-2 flex-grow">
                        <option value="" disabled selected>-- Select Menu --</option>
                        <?php foreach ($menu_items as $item) { ?>
                            <option value="<?php echo $item['ID'] ?>"
                            <?php if ($menu['menu_ID'] == $item['ID']) echo "selected";?>><?php echo $item['menu']; ?></option>
                        <?php } ?>
                        </select>
                        <button type="button" class="bg-red-500 text-white w-10 h-10 rounded-lg"> - </button>
                    </div>
            <?php $menu_q++; } } ?>
        </div>
        <div class="flex flex-row justify-between">
            <label for="harga" class="text-gray-700">Total Harga</label>
            <input type="text" name="<?=$opt . "_harga"?>" id="harga" class="text-gray-700 font-semibold border-none bg-transparent focus:outline-none" value="Rp<?php if (isset($_GET['id'])) echo $update['harga']; else echo '0'?>" readonly unselectable="on">
        </div>
        <button type="submit" name="<?=$send . "_order"?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            <?php if (isset($_GET['id'])) echo "Update"; else echo "Add"; ?> Order
        </button>
    </form>
</div>

<script>
    $(document).ready(function() {
        var menu_q = $("#menus").children().length > 1 ? $("#menus").children().length - 2 : 0;
        $("#menus").append(`
            <div class="flex items-center gap-4 menu_${menu_q}">
                <select name="<?=$opt . "_menu_IDs["?>${menu_q}<?="]"?>" id="menu_IDs" required class="border border-gray-300 rounded-md px-4 py-2 flex-grow">
                <option value="" disabled selected>-- Select Menu --</option>
                <?php foreach ($menu_items as $item) { ?>
                    <option value="<?php echo $item['ID']; ?>"><?php echo $item['menu']; ?></option>
                <?php } ?>
                </select>
                <button type="button" id="add-menu" class="bg-green-500 text-white w-10 h-10 rounded-lg flex items-center justify-center btn_${menu_q}"> + </button>
            </div>
        `);

        $(document).on("click", "#add-menu", function() {
            $("#menus").append(`
                <div class="flex items-center gap-4 menu_${menu_q + 1}">
                    <select name="<?=$opt . "_menu_IDs["?>${menu_q + 1}<?="]"?>" id="menu_IDs" required class="border border-gray-300 rounded-md px-4 py-2 flex-grow">
                    <option value="" disabled selected>-- Select Menu --</option>
                    <?php foreach ($menu_items as $item) { ?>
                        <option value="<?php echo $item['ID']; ?>"><?php echo $item['menu']; ?></option>
                    <?php } ?>
                    </select>
                     <button type="button" id="add-menu" class="bg-green-500 text-white w-10 h-10 rounded-lg flex items-center justify-center btn_${menu_q + 1}"> + </button>
                </div>
            `);
            $(".menu_" + menu_q).find("button").remove();
            $(".menu_" + menu_q).append('<button type="button" class="bg-red-500 text-white w-10 h-10 rounded-lg"> - </button>');
            menu_q++;
        });
        
        $(document).on("change", "select#menu_IDs", () => calculateTotal());
        $(document).on("click", ".bg-red-500", function() {
            $(this).parent().remove();
            calculateTotal();
        });


        function calculateTotal() {
            var total = 0;
            $("select#menu_IDs").each(function() {
                var value = $(this).val();
                if (value) {
                    $.ajax({
                        url: 'get_price.php',
                        type: 'GET',
                        data: { menu: value },
                        dataType: 'json',
                        success: function(response) {
                            if (!isNaN(parseInt(response[0].price))) {
                                total += parseInt(response[0].price);
                                $("#harga").val("Rp" + total);
                            }
                        }
                    });
                }
            });
        }
    });
</script>