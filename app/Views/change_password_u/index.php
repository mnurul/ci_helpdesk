<?= $this->extend('change_password_u/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto h-100vh" style="margin-top: 60px;">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-md-4 " style="margin-top: 80px;">
            <?php $uri = service('uri'); ?>

            <h1 class="title font-weight-bold">Buat Password</h1>
            <p class="text-secondary h8 mt-1 mb-1 desc-title">Gunakan kombinasi yang aman</p>
            <!-- cek validasi -->
            <?php
            $berhasil = session()->getFlashdata('berhasil');
            $pesan = session()->getFlashdata('pesan');
            $gagal = session()->getFlashdata('gagal');
            $gagalupdate = session()->getFlashdata('gagalupdate');
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
            <?php  } elseif (!empty($pesan)) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $pesan; ?>
                </div>
            <?php  } elseif (!empty($gagalupdate)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $gagalupdate; ?>
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
            <form action="/Login/update_password_u/" method="post">
                <?= csrf_field(); ?>

                <div class="row">

                    <div class="form-group">
                        <div class="col-25">
                            <label for="iduser">Password</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="iduser" name="iduser" value="<?= session()->get('reset_email'); ?>" placeholder="Password" autofocus required readonly>
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
            </form>

        </div>

    </div>

    <?= $this->endSection(); ?>