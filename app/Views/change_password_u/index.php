<?= $this->extend('change_password_u/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto h-100vh" style="margin-top: 60px;">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-md-4 " style="margin-top: 80px;">
            <h1 class="title font-weight-bold">Buat Password</h1>
            <p class="text-secondary h8 mt-1 mb-1 desc-title">Gunakan kombinasi yang aman</p>
            <!-- cek validasi -->
            <?php
            $berhasil = session()->getFlashdata('berhasil');
            $gagal = session()->getFlashdata('gagal');
            $inputs = session()->getFlashdata('inputs');
            $errors = session()->getFlashdata('errors');
            if (!empty($berhasil)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $berhasil; ?>
                </div>
            <?php } elseif (!empty($gagal)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $gagal; ?>
                </div>
            <?php  } elseif (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li style="margin-left: -10px;"><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php }
            ?>

            <!-- <form action="/action_page.php"> -->
            <?= form_open('Login/update_password_u') ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="password" name="password" value="<?= $user['iduser']; ?>" placeholder="Password" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="password" name="password" placeholder="Password" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-25">
                        <label for="cpassword">Confirm</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-75">
                    <button type="submit" class="btn btn-login">Simpan Password</button>
                </div>
            </div>
            <!-- </form> -->
            <?= form_close(); ?>
        </div>

    </div>

</div>

<?= $this->endSection(); ?>