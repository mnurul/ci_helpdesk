<?= $this->extend('detail_user/template'); ?>

<?= $this->section('content'); ?>

<!-- <div class="container">
    <div class="row">
        <div class="col ">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="margin-left: auto;">
                        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="#">Features</a>
                        <a class="nav-item nav-link" href="#">Pricing</a>
                        <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </div>
                </div>
            </nav>
        </div>

        
    </div>

</div> -->

<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h6 class="t-customer"><b>Welcome Customer</b></h6> -->
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/admin/list_user">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Detail User</h2>
                <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <?php
                        $pesan = session()->getFlashdata('pesan');
                        $failed = session()->getFlashdata('failed');
                        $inputs = session()->getFlashdata('inputs');
                        $errors = session()->getFlashdata('errors');
                        if (!empty($pesan)) { ?>
                            <div class="alert alert-success alert-pesan" role="alert">
                                <?= $pesan; ?>
                            </div>
                        <?php } elseif (!empty($failed)) { ?>
                            <div class="alert alert-danger alert-failed" role="alert">
                                <?= $failed; ?>
                            </div>
                        <?php } elseif (!empty($errors)) { ?>
                            <div class="alert alert-danger alert-error" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li style="margin-left: -10px;"><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php }
                        ?>
                        <form action="/admin/edit_user/<?= $user['iduser']; ?>" method="post">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="iduser">Id User</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="iduser" name="iduser" autofocus value="<?= (old('iduser')) ? old('iduser') : $user['iduser']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="username">Username</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="username" name="username" value="<?= (old('username')) ? old('username') : $user['username']; ?>">
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="password">Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="password" name="password">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="level">Level</label>
                                </div>
                                <div class="col-75">
                                    <select id="level" name="level" style="height:45px !important;">
                                        <!-- <option value="" ></option> -->
                                        <option value="<?= (old('level')) ? old('level') : $user['level']; ?>" selected><?= ucwords($user['level']); ?></option>
                                        <option value="customer" <?= ($user['level'] == 'customer' ? 'hidden' : 'customer') ?>>Customer</option>
                                        <option value="teknisi" <?= ($user['level'] == 'teknisi' ? 'hidden' : 'teknisi') ?>>Teknisi</option>
                                        <option value="admin" <?= ($user['level'] == 'admin' ? 'hidden' : 'admin') ?>>Admin</option>
                                        <option value="manager" <?= ($user['level'] == 'manager' ? 'hidden' : 'manager') ?>>Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="fullname">Fullname</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fullname" name="fullname" value="<?= (old('fullname')) ? old('fullname') : $user['fullname']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="email">Email</label>
                                </div>
                                <div class="col-75">
                                    <input type="email" id="email" name="email" value="<?= (old('email')) ? old('email') : $user['email']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="telp">Telp</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="telp" name="telp" value="<?= (old('telp')) ? old('telp') : $user['telp']; ?>">
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="emailcode">Email Code</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="emailcode" name="emailcode" value="<?= (old('emailcode')) ? old('emailcode') : $user['emailcode']; ?>">
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="time">Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="time" name="time" value="<?= (old('time')) ? old('time') : $user['time']; ?>">
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="confirmed">Confirmed</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="confirmed" name="confirmed" value="<?= (old('confirmed')) ? old('confirmed') : $user['confirmed']; ?>">
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="ip">Ip</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="ip" name="ip" value="<?= (old('ip')) ? old('ip') : $user['ip']; ?>">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-75">
                                    <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-edit">Edit</button>
                                            <!-- <a href="/admin/edit_user/<?= $user['iduser']; ?>" class="btn btn-edit">Edit</a> -->
                                        </div>
                                        <div class="col">
                                            <!-- <form action="/admin/delete/<?= $user['iduser']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                            </form> -->
                                            <!-- <a href="" class="btn btn-delete">Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-75">
                                <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                <div class="row">
                                    <div class="col">
                                        <!-- <button type="submit" class="btn btn-edit">Edit</button> -->
                                        <!-- <a href="/admin/edit_user/<?= $user['iduser']; ?>" class="btn btn-edit">Edit</a> -->
                                    </div>
                                    <div class="col">
                                        <form action="/admin/<?= $user['iduser']; ?>" method="post" class="d-inline">
                                            <!-- Fitur keamanan ci4 buat form!-- -->
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                        </form>
                                        <!-- <a href="" class="btn btn-delete">Delete</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <form action="/action_page.php">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="n-ticket">No Ticket</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="n-ticket" name="n-ticket">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="r-date">Reported Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="r-date" name="r-date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="p-summary">Problem Summary</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="p-summary" name="p-summary" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="date">Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="date" name="date" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="teknisi">Teknisi</label>
                                </div>
                                <div class="col-75">
                                    <select id="teknisi" name="teknisi" style="padding-top: -30px !important;">
                                        <option value=""></option>
                                        <option value="Teknisi">Teknisi</option>
                                        <option value="Teknisi">Teknisi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn btn-ticket">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
</div>
</div>


<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<?= $this->endSection(); ?>