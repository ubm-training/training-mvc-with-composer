<?php include_once __DIR__.'/../../views/header.php'; ?>
    <h3>TẠO THÊM BAN</h3>
    <form action="<?=route('POST_BAN_STORE') ?>" method="post">
        <label for="ten_ban">Tên ban:</label>
        <input id="ten_ban" name="ten_ban" placeholder="nhập tên Ban cần thêm mới" required />
        <button type="submit">Thêm</button>
    </form>
<?php include_once __DIR__.'/../../views/footer.php'; ?>