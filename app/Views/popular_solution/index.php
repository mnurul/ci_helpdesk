<?= $this->extend('popular_solution/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>
    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/admin/my_assigment_a" class="btn navbar <?= ($uri->getSegment(2) == 'my_assigment_a' ? 'active' : null) ?>">My Assigment</a>
    <!-- <a href="<?= base_url(); ?>/admin/my_resolution" class=" btn navbar">My Resolution</a> -->
    <a href="<?= base_url(); ?>/admin/w_for_close" class="btn navbar <?= ($uri->getSegment(2) == 'w_for_close' ? 'active' : null) ?>">Waiting for Close</a>
    <a href="<?= base_url(); ?>/admin/v_all_ticket_a" class="btn navbar <?= ($uri->getSegment(2) == 'v_all_ticket_a' ? 'active' : null) ?>">View All Tickets</a>
    <a href="<?= base_url(); ?>/admin/popular_solution" class="btn navbar <?= ($uri->getSegment(2) == 'popular_solution' ? 'active' : null) ?>">Popular Solution</a>
    <h6 class="t-view-report"><b>Start Asking</b></h6>
    <br>
    <!-- <a href="<?= base_url(); ?>/admin/pivot_table_a" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table_a' ? 'active' : null) ?>">Pivot Table</a> -->
    <a href="<?= base_url(); ?>/admin/correct_word" class="btn navbar <?= ($uri->getSegment(2) == 'correct_word' ? 'active' : null) ?>">Correct Word</a>
    <a href="<?= base_url(); ?>/admin/edc" class="btn navbar <?= ($uri->getSegment(2) == 'edc' ? 'active' : null) ?>">EDC</a>
    <a href="<?= base_url(); ?>/admin/vocabs" class="btn navbar <?= ($uri->getSegment(2) == 'vocabs' ? 'active' : null) ?>">Vocabs</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-admin"><b>Welcome <?= session()->get('username'); ?></b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-manager.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href=" <?= base_url(); ?>/admin/">Back </a>
                    <a href="<?= base_url(); ?>/admin/change_password_a" class="">Change Password</a>
                    <a href="<?= base_url(); ?>/admin/list_project" class="<?= ($uri->getSegment(2) == 'list_project' ? 'active' : null) ?>">Projects</a>
                    <a href="<?= base_url(); ?>/admin/list_customer" class="<?= ($uri->getSegment(2) == 'list_customer' ? 'active' : null) ?>">Customers</a>
                    <a href="<?= base_url(); ?>/admin/list_user" class="<?= ($uri->getSegment(2) == 'list_user' ? 'active' : null) ?>">Users</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">Popular Solution</h2>
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
                                <?php foreach ($popular_solution as $t) : ?>
                                    <div class="column">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-6">
                                                    <h6 class="card-subtitle st-ticket text-muted mb-2"><?= $t['idcustomer']; ?></h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="card-subtitle mb-2 st-date text-muted"><?= $t['reportdate']; ?></h6>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 10px;">
                                            <h5 class="card-title text"><?= $t['problemsummary']; ?></h5>
                                            <div class="btn-assign" datahover="test" title="<?= ($t['ticketstatus'] == 'Closed' ? 'Ticket ini udah kamu Closed'   : null) ?>">
                                                <a href="<?= base_url(); ?>/admin/detail_popular_solution/<?= $t['idtickets']; ?>" class="a-assign <?= ($t['ticketstatus'] == 'Closed' ? 'disable'   : null) ?>">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <!-- <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Problem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_popular_solution" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Problem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_popular_solution" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Problem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_popular_solution" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Problem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_popular_solution" class=" btn-assign">Detail</a>
                                    </div>
                                </div> -->
                            </div>
                            <?= $pager->links('popular_solution', 'user_pagination') ?>
                            <a href="<?= base_url(); ?>/teknisi/popular_solution" title="Back to view all data">
                                <h6 class="card-subtitle st-ticket text-muted mt-1">All data <?= $count_resolve; ?></h6>
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
        <a href="#">My Request</a>
        <a href="#">My Assigment</a>
        <a href="#">My Resolution</a>
        <a href="#">Waiting for Close</a>
        <a href="#">View All Tickets</a>
        <a href="#">Popular Solution</a>
        <a href="#">Search Tickets</a>
    </div>
</div>
<div class="dropup">
    <button class="dropbtn">View Report</button>
    <div class="dropup-content">
        <a href="#">Pivot Table</a>
        <a href="#">SLA Chart</a>
    </div>
</div> -->
<div class="dropup">
    <div class="col-6" style="bottom: 0; margin-left:170px;margin-bottom:-40px !important">
        <button class="dropbtn">Start Asking</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/admin/correct_word" class="<?= ($uri->getSegment(2) == 'correct_word' ? 'active' : null) ?>">Correct Word</a>
            <a href="<?= base_url(); ?>/admin/edc" class="<?= ($uri->getSegment(2) == 'edc' ? 'active' : null) ?>">EDC</a>
            <a href="<?= base_url(); ?>/admin/vocabs" class="<?= ($uri->getSegment(2) == 'vocabs' ? 'active' : null) ?>">Vocabs</a>
        </div>
    </div>
    <div class="col-6" style="margin-left:-15px;">
        <button class="dropbtn">My Ticket</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/admin/my_assigment_a" class=" <?= ($uri->getSegment(2) == 'my_assigment_a' ? 'active' : null) ?>">My Assigment</a>
            <a href="<?= base_url(); ?>/admin/w_for_close" class="<?= ($uri->getSegment(2) == 'w_for_close' ? 'active' : null) ?>">Waiting for Close</a>
            <a href="<?= base_url(); ?>/admin/v_all_ticket_a" class=" <?= ($uri->getSegment(2) == 'v_all_ticket_a' ? 'active' : null) ?>">View All Tickets</a>
            <a href="<?= base_url(); ?>/admin/popular_solution" class=" <?= ($uri->getSegment(2) == 'popular_solution' ? 'active' : null) ?>">Popular Solution</a>
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