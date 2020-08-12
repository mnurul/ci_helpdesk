<?php

use Config\Validation;
?>
<?= $this->extend('create_project/template'); ?>

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
                <a href="<?= base_url(); ?>/admin/list_project">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Create Project</h2>
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
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="useid" hidden>Id Project</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="useid" name="useid" value="<?= $builder['idproject']  ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idproject">Id Project</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="idproject" name="idproject" placeholder="Last <?= $builder['idproject']  ?>" value="<?= $idproject; ?>" autofocus required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-25">
                                    <label class="title-1" for="namaproject">Nama Project</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="namaproject" name="namaproject" value="<?= $namaproject; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csnama">Nama Customer</label>
                                </div>
                                <div class="col-75">
                                    <select id="csnama" name="csnama" style="height:45px !important;" required>
                                        <option value="<?= $idcustomer; ?>"><?= $idcustomer; ?></option>
                                        <?php foreach ($customer as $u) : ?>
                                            <option value="<?= $u['idcustomer'] ?>"><?= $u['csnama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="dbegin">Delivery Begin</label>
                                    <!-- <label class="title-3" for="dbegin">Delivery Begin</label> -->
                                </div>
                                <div class="col-75">
                                    <input type="date" id="dbegin" name="dbegin" value="<?= $deliveyrbegin; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="dend">Delivery End</label>
                                    <!-- <label class="title-1" for="dend">Delivery End</label> -->
                                </div>
                                <div class="col-75">
                                    <input type="date" id="dend" name="dend" value="<?= $deliveryend; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idate">Install Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="idate" name="idate" value="<?= $installdate; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="iend">Install End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="iend" name="iend" value="<?= $installend; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="uatbegin">UAT Begin</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="uatbegin" name="uatbegin" value="<?= $uatbegin; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="uatend">UAT End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="uatend" name="uatend" value="<?= $uatend; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="billstartd">Bill Start Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="billstartd" name="billstartd" value="<?= $billstartdate; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="billduee">Bill Due End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="billduee" name="billduee" value="<?= $billdueend; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="wperiod">Waranty Period</label>
                                </div>
                                <div class="col-75">
                                    <input type="number" id="wperiod" name="wperiod" required value="<?= $warantyperiod; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cstartdate">Contract Start Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="cstartdate" name="cstartdate" required value="<?= $contractstartdate; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cenddate">Contract End Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="number" id="cenddate" name="cenddate" required value="<?= $contractenddate; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn-ticket">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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