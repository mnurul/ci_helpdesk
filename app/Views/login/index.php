<?= $this->extend('login/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 " style="margin-top: 80px;">
            <img src="<?= base_url(); ?>/assets/image1.png" class="logo" alt=""></>
            <h1 class="title font-weight-bold">Sign in</h1>
            <!-- <form action="">
                <div class="form-group">
                    <label class="title-1" for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label class="title-1" for="Password">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Password">
                </div>
                <div>

                    <a href="http://"><label class="title-2">Lupa Password</label></a>
                </div>
                <button type="submit" class="btn btn-login">Masuk Akun Saya</button>
            </form> -->




            <!-- cek validasi -->
            <?php
            $salah = session()->getFlashdata('salah');
            $logout = session()->getFlashdata('logout');
            $inputs = session()->getFlashdata('inputs');
            $pesan = session()->getFlashdata('pesan');
            $errors = session()->getFlashdata('errors');
            if (!empty($salah)) { ?>
                <div class="alert alert-danger alert-failed" role="alert">
                    <?= $salah; ?>
                </div>
            <?php } elseif (!empty($logout)) { ?>
                <div class="alert alert-danger alert-failed" role="alert">
                    <?= $logout; ?>
                </div>
            <?php } elseif (!empty($pesan)) { ?>
                <div class="alert alert-success alert-pesan" role="alert">
                    <?= $pesan; ?>
                </div>
            <?php  } elseif (!empty($errors)) { ?>
                <div class="alert alert-danger alert-failed" role="alert">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li style="margin-left: -10px;"><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php }
            ?>

            <!-- <form action="/action_page.php"> -->
            <form action="/Login/cekLogin/" method="post" id="form_login">
                <!-- Fitur baru ci4, form disi hanya bisa lewat hal web -->
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group">
                        <div class="col-25">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" autofocus required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-25">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <a href="<?= base_url(); ?>/login/forgot_password"><label style="cursor: pointer;">Lupa Password</label></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <button type="submit" class="btn btn-login">Masuk Akun Saya</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



<?= $this->endSection(); ?>