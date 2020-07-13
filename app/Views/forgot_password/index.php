<?= $this->extend('forgot_password/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto h-100vh" style="margin-top: 90px;">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-md-4 " style="margin-top: 80px;">
            <div class="row">
                <div class="col-75">
                    <a href="<?= base_url(); ?>" class="kembali"><label>Kembali</label></a>
                </div>
            </div>
            <h1 class="title font-weight-bold">Lupa Password</h1>
            <p class="text-secondary h8 mt-1 mb-1 desc-title">Let's get back your account today.</p>
            <!-- cek validasi -->
            <?php
            $salah = session()->getFlashdata('salah');
            $send = session()->getFlashdata('send');
            if (!empty($salah)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $salah; ?>
                </div>
            <?php } elseif (!empty($send)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $send; ?>
                </div>
            <?php  } ?>


            <!-- <form action="/action_page.php"> -->
            <?= form_open('Login/forgot_password2') ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" placeholder="Email" autofocus required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-75">
                    <button type="submit" class="btn btn-login">Dapatkan Password</button>
                </div>
            </div>
            <!-- </form> -->
            <?= form_close(); ?>
        </div>

    </div>

</div>

<?= $this->endSection(); ?>