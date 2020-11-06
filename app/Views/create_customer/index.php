<?php

use Config\Validation;
?>
<?= $this->extend('create_customer/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h6 class="t-customer"><b>Welcome Customer</b></h6> -->
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/admin/list_customer">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Create Customer</h2>
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
                        <form action="" method="post">
                            <?php if ($_SERVER["REQUEST_METHOD"] != "POST") { ?>
                                <label class="title-1" for="" value="<?= $idcustomer1; ?>"></label>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="idcustomer" hidden>Id Customer</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="idcustomer" name="idcustomer" value="<?= $idcustomer1  ?>" autofocus required hidden>
                                    </div>
                                </div>
                            <?php  } ?>

                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idcustomer">Id Customer</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="idcustomer" name="idcustomer" placeholder="Last <?= ($_SERVER["REQUEST_METHOD"] == "POST" ? null   : $idcustomer1) ?>" value="<?= ($_SERVER["REQUEST_METHOD"] == "POST" ? $idcustomer   : null) ?>" autofocus required>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csnama">Nama</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="csnama" value="<?= $csnama; ?>" name="csnama" style="color: black;" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="alamat">Alamat</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="alamat" name="alamat" style="height:200px"><?= $alamat; ?></textarea> </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="telp">Telp</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save" id="telp" name="telp" value="<?php echo $telp; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="email">Email</label>
                                </div>
                                <div class="col-75">
                                    <input type="email" class="auto-save" id="email" name="email" value="<?= $email; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="pic">PIC</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="pic" name="pic" value="<?= $pic; ?>" required>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csproduct">Customer Product</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="csproduct" name="csproduct" value="" required>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="time">Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="time" name="time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="ip">Ip</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="ip" name="ip">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn-ticket">Submit</button>
                                </div>
                            </div>
                        </form>
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
<script>
    $('.auto-save').savy('load');

    // you can pass a function to be called when savy is finished loading.
    $('.auto-save').savy('load', function() {
        console.log("All data from savy are loaded");
    });

    $('.auto-save').savy('destroy');

    // you can pass a function to be called when savy is destroyed.
    $('.auto-save').savy('destroy', function() {
        console.log("All data from savy are destroyed");
    });
</script>

<?= $this->endSection(); ?>