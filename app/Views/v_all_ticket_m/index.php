<?= $this->extend('v_all_ticket_m/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>

    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/v_all_ticket_m" class="btn navbar <?= ($uri->getSegment(2) == 'v_all_ticket_m' ? 'active' : null) ?>">View All Tickets</a>
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/pivot_table" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">Pivot Table</a>
    <a href="<?= base_url(); ?>/manager/sla_chart" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">SLA Chart</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-manager"><b>Welcome <?= session()->get('username'); ?></b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-manager.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href="<?= base_url(); ?>/manager">Back</a>
                    <a href="<?= base_url(); ?>/manager/change_password_m" class="">Change Password</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">View All Ticket</h2>
                    <div class="card bg-card mt-3 mb-5">
                        <div class="card-body">
                            <form action="" method="post">
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
                                <?php foreach ($tickets as $t) : ?>
                                    <div class="column">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-6">
                                                    <h6 class="card-subtitle mb-2 st-ticket text-muted"><?= $t['noticket']; ?></h6>
                                                    <h6 class="card-subtitle mb-2 st-ticket text-muted"><?= $t['namasla']; ?></h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="card-subtitle mb-2 st-date text-muted"><?= $t['reportdate']; ?></h6>
                                                    <h6 class="card-subtitle mb-2 st-date text-muted"><?= $t['ticketstatus']; ?></h6>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 10px;">
                                            <h6 class="card-subtitle mb-2 st-date text-muted"><?= $t['csnama']; ?></h6>
                                            <h5 class="card-title text"><?= $t['problemsummary']; ?></h5>
                                            <a href="#" class=" btn-assign"><?= $t['username']; ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <!-- <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">No. Ticket</h6>
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">SLA</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Status</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h6 class="card-subtitle mb-2 st-date text-muted">Customer</h6>
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="#" class=" btn-assign">Teknisi</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">No. Ticket</h6>
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">SLA</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Status</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h6 class="card-subtitle mb-2 st-date text-muted">Customer</h6>
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="#" class=" btn-assign">Teknisi</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">No. Ticket</h6>
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">SLA</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Status</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h6 class="card-subtitle mb-2 st-date text-muted">Customer</h6>
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="#" class=" btn-assign">Teknisi</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">No. Ticket</h6>
                                                <h6 class="card-subtitle mb-2 st-ticket text-muted">SLA</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Status</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h6 class="card-subtitle mb-2 st-date text-muted">Customer</h6>
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="#" class=" btn-assign">Teknisi</a>
                                    </div>
                                </div> -->
                            </div>
                            <?= $pager->links('tickets', 'user_pagination') ?>
                            <a href="<?= base_url(); ?>/manager/v_all_ticket_m" title="Back to view all data">
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


<!-- <div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="<?= base_url(); ?>/manager/v_all_ticket_m">View All Tickets</a>
    </div>
</div> -->
<div class="dropup">
    <div class="col-6" style="bottom: 0; margin-left:170px;margin-bottom:-40px !important">
        <button class="dropbtn">View Report</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/manager/pivot_table" class="<?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">Pivot Table</a>
            <a href="<?= base_url(); ?>/manager/sla_chart" class="<?= ($uri->getSegment(2) == 'sla_chart' ? 'active' : null) ?>">SLA Chart</a>
        </div>
    </div>
    <div class="col-6" style="margin-left:-15px;">
        <button class="dropbtn">My Tickets</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/manager/v_all_ticket_m" class="<?= ($uri->getSegment(2) == 'v_all_ticket_m' ? 'active' : null) ?>">View All Tickets</a>
        </div>
    </div>
</div>
<!-- <div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="#">Link 5</a>
        <a href="#">Link 6</a>
        <a href="#">Link 7</a>
    </div>
</div> -->


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