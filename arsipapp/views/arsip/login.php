<div class="sign-wrapper">
    <div class="sign-box">
        <div class="sign-title">Masuk</div>
        <form action="<?= base_url("login/processlogin") ?>" method="post" class="sign-form">
            <input autofocus type="text" name="username" id="username" class="sign-input" placeholder="Username" required>
            <input type="password" name="password" id="password" class="sign-input" placeholder="Password" required>
            <input type="submit" value="Masuk" class="sign-input sign-btn">
        </form>
        <a href="<?= base_url("daftar") ?>">Balum memiliki akun? Daftar sekarang</a>
    </div>
</div>