<?= $this->extend('detail_project/template'); ?>

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
                <h2 class="title font-weight-bold">Detail Project</h2>
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
                        <form action="/admin/edit_project/<?= $project['idproject']; ?>" method="post">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idproject">Id Project</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="idproject" name="idproject" autofocus value="<?= (old('idproject')) ? old('idproject') : $project['idproject']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="namaproject">Nama Project</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="namaproject" name="namaproject" value="<?= (old('namaproject')) ? old('namaproject') : $project['namaproject']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csnama">Nama Customer</label>
                                </div>
                                <div class="col-75">
                                    <select id="csnama" name="csnama" style="height:45px !important;">
                                        <!-- <option value="" ></option> -->
                                        <option value="<?= $project['idcustomer'] ?>" selected> <?= $project['csnama']; ?></option>
                                        <?php foreach ($customer as $u) : ?>
                                            <option value="<?= $u['idcustomer'] ?>" <?= ($u['idcustomer'] == $project['idcustomer'] ? 'hidden' : $u['csnama']) ?>><?= $u['csnama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csnama">Nama Customer</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="csnama" name="csnama" value="<?= (old('csnama')) ? old('csnama') : $project['csnama']; ?>">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="dbegin">Delivery Begin</label>
                                    <!-- <label class="title-3" for="dbegin">Delivery Begin</label> -->
                                </div>
                                <div class="col-75">
                                    <input type="date" id="dbegin" name="dbegin" value="<?= (old('dbegin')) ? old('dbegin') : $project['deliveyrbegin']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="dend">Delivery End</label>
                                    <!-- <label class="title-1" for="dend">Delivery End</label> -->
                                </div>
                                <div class="col-75">
                                    <input type="date" id="dend" name="dend" value="<?= (old('dend')) ? old('dend') : $project['deliveryend']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idate">Install Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="idate" name="idate" value="<?= (old('idate')) ? old('idate') : $project['installdate']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="iend">Install End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="iend" name="iend" value="<?= (old('iend')) ? old('iend') : $project['installend']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="uatbegin">UAT Begin</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="uatbegin" name="uatbegin" value="<?= (old('uatbegin')) ? old('uatbegin') : $project['uatbegin']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="uatend">UAT End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="uatend" name="uatend" value="<?= (old('uatend')) ? old('uatend') : $project['uatend']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="billstartd">Bill Start Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="billstartd" name="billstartd" value="<?= (old('billstartd')) ? old('billstartd') : $project['billstartdate']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="billduee">Bill Due End</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="billduee" name="billduee" value="<?= (old('billduee')) ? old('billduee') : $project['billdueend']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="wperiod">Waranty Period</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="wperiod" name="wperiod" value="<?= (old('wperiod')) ? old('wperiod') : $project['warantyperiod']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cstartdate">Contract Start Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="date" id="cstartdate" name="cstartdate" value="<?= (old('cstartdate')) ? old('cstartdate') : $project['contractstartdate']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cenddate">Contract End Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="cenddate" name="cenddate" value="<?= (old('cenddate')) ? old('cenddate') : $project['contractenddate']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-edit">Edit</button>
                                            <!-- <a href="/admin/edit_user/<?= $project['idproject']; ?>" class="btn btn-edit">Edit</a> -->
                                        </div>
                                        <div class="col">
                                            <!-- <form action="/admin/delete/<?= $project['idproject']; ?>" method="POST" class="d-inline">
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
                                        <!-- <a href="/admin/edit_user/<?= $project['idproject']; ?>" class="btn btn-edit">Edit</a> -->
                                    </div>
                                    <div class="col">
                                        <form action="/project/<?= $project['idproject']; ?>" method="post" class="d-inline">
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