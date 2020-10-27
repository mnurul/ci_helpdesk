<?= $this->extend('v_ticket_status/template'); ?>

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
            <h6 class="t-customer"><b>Welcome <?= session()->get('username'); ?></b></h6>
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/login/logout">Logout</a>
                <!-- <a href=" <?= base_url(); ?>/user/">Back </a>  -->
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <!-- <a href="<?= base_url(); ?>/user/create_ticket" class="">Create Tickets</a> -->
                <a href="<?= base_url(); ?>/user/start_asking" class="">Start Asking</a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">View Ticket Status</h2>
                <div class="card bg-card mt-3 mb-5">
                    <div class="card-body">
                        <form action="" method="post" class="t-form">
                            <div class="input-group col-7 justify-content-center" style="margin-left: 195px !important;">
                                <input type="text" class="form-control" name="search" style="width:543px !important;" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
                            </div>
                        </form>
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
                        <div class="row">
                            <?php foreach ($idcs as $w) : ?>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted"><?= $w['noticket']; ?></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted"><?= $w['idcustomer']; ?></h6>
                                                <!-- <h6 class="card-subtitle st-date text-muted">Date</h6> -->
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text"><?= $w['problemsummary']; ?></h5>
                                        <!-- <a href="#" class="btn btn-status">Detail</a> -->
                                        <div class="" datahover="test" title="<?= ($w['noticket'] == null ? 'Ticket kamu belum di Assigned'   : null) ?>">
                                            <a href="<?= base_url(); ?>/user/detail_t_status/<?= $w['noticket']; ?>" class="btn btn-status <?= ($w['noticket'] == null ? 'disable-pointer' : null) ?>">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">No. Ticket</h6>

                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            <h6 class="card-subtitle st-date text-muted">Date</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">Promblem Summary</h5>
                                    <a href="#" class="btn btn-status">Status</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">No. Ticket</h6>

                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            <h6 class="card-subtitle st-date text-muted">Date</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">Promblem Summary</h5>
                                    <a href="#" class="btn btn-status">Status</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">No. Ticket</h6>

                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            <h6 class="card-subtitle st-date text-muted">Date</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">Promblem Summary</h5>
                                    <a href="#" class="btn btn-status">Status</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">No. Ticket</h6>

                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            <h6 class="card-subtitle st-date text-muted">Date</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">Promblem Summary</h5>
                                    <a href="#" class="btn btn-status">Status</a>
                                </div>
                            </div> -->
                        </div><br><br>
                        <!-- Menggunakan makeLinks bukan links karna ada where dan atribut nya hanya "key" dan "nama template" -->
                        <?= $pager->makeLinks(1, $tampil, $total, 'user_pagination') ?>



                        <a href="<?= base_url(); ?>/user/" title="Back to view all data">
                            <h6 class="card-subtitle st-ticket text-muted mt-1">All data <?= $count; ?></h6>
                        </a>
                        <!-- <div class="pagination justify-content-center ">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a class="active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div> -->
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