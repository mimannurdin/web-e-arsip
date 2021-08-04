<div class="sign-wrapper">
    <div class="sign-box">
        <div class="sign-title">Daftar</div>
        <form action="<?= base_url("daftar/processdaftar") ?>" method="post" class="sign-form">
            <input autofocus type="text" name="username" id="username" class="sign-input" placeholder="Username" pattern="[a-z0-9_]+" title="a-z atau 0-9_" required>
            <input type="password" name="password" id="password" class="sign-input" placeholder="Password" pattern="[A-Za-z0-9.,@!#$%&*].{5,}" title="Minimal 6 karakter A-Z or a-z or 0-9 or .,@!#$%&*" required>
            <input type="text" name="nama" id="nama" class="sign-input" placeholder="Nama" required>
            <select name="unit" id="unit" class="sign-input" required>
                <option value="Unit" disabled selected>Unit</option>
                <option value="kepegawaian">Kepegawaian</option>
                <option value="umum">Umum</option>
                <option value="keuangan">Keuangan</option>
            </select>
            <input type="submit" value="Daftar" class="sign-input sign-btn">
        </form>
    </div>
</div>