<?= $this->extend('v_all_ticket/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>

    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/teknisi/my_assigment" class="btn navbar <?= ($uri->getSegment(2) == 'my_assigment' ? 'active' : null) ?>">My Assigment</a>
    <a href=" <?= base_url(); ?>/teknisi/v_all_ticket" class="btn navbar <?= ($uri->getSegment(2) == 'v_all_ticket' ? 'active' : null) ?>">View My Tickets</a>
</div>


<div class=" content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-teknisi"><b>Welcome <?= session()->get('username'); ?></b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href=" <?= base_url(); ?>/teknisi/">Back </a>
                    <a href="<?= base_url(); ?>/teknisi/change_password_t" class="">Change Password</a>
                    <a href=" javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">View My Ticket</h2>
                    <div class="card bg-card mt-3 mb-5">
                        <div class="card-body">
                            <div class="myInput">
                                <form action="" method="post">
                                    <div class="input-group col-7 justify-content-center " style="margin-left: 195px !important;">
                                        <input type="text" class="form-control" name="search" style="width:543px !important;" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
                                    </div>
                                </form>
                            </div>
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
                                <?php foreach ($v_all_ticket as $t) : ?>
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
                                            <h5 class="card-title text"><?= $t['problemsummary']; ?></h5>
                                            <div class="btn-assign" datahover="test" title="<?= ($t['ticketstatus'] == 'Resolved' ? 'Ticket ini udah kamu Resolved'   : null) ?>">
                                                <a href="<?= base_url(); ?>/teknisi/change_status_t/<?= $t['idtickets']; ?>" class="a-assign <?= ($t['ticketstatus'] == 'Resolved' ? 'disable'   : null) ?>">Change Status</a>
                                            </div>
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
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/teknisi/change_status_t" class=" btn-assign">Change Status</a>
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
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/teknisi/change_status_t" class=" btn-assign">Change Status</a>
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
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/teknisi/change_status_t" class=" btn-assign">Change Status</a>
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
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/teknisi/change_status_t" class=" btn-assign">Change Status</a>
                                    </div>
                                </div> -->
                            </div>
                            <?= $pager->links('v_all_ticket', 'user_pagination') ?>
                            <a href="<?= base_url(); ?>/teknisi/v_all_ticket" title="Back to view all data">
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


<div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="<?= base_url(); ?>/teknisi/my_assigment" class="<?= ($uri->getSegment(2) == 'my_assigment' ? 'active' : null) ?>">My Assigment</a>
        <a href="<?= base_url(); ?>/teknisi/v_all_ticket" class="<?= ($uri->getSegment(2) == 'v_all_ticket' ? 'active' : null) ?>">View All Tickets</a>
    </div>
</div>

<!-- <div class="dropup">
    <div class="col-6" style="margin-left:-15px;">
        <button class="dropbtn">My Ticket</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/teknisi/my_assigment" class="<?= ($uri->getSegment(2) == 'my_assigment' ? 'active' : null) ?>">My Assigment</a>
            <a href="<?= base_url(); ?>/teknisi/v_all_ticket" class="<?= ($uri->getSegment(2) == 'v_all_ticket' ? 'active' : null) ?>">View All Tickets</a>
        </div>
    </div>
</div> -->

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