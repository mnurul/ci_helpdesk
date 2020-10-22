<?= $this->extend('list_project/template'); ?>

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
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="<?= base_url(); ?>/admin/pivot_table_a" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table_a' ? 'active' : null) ?>">Pivot Table</a>
    <a href="<?= base_url(); ?>/admin/sla_chart_a" class="btn navbar <?= ($uri->getSegment(2) == 'sla_chart_a' ? 'active' : null) ?>">SLA Chart</a>
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
                    <h2 class="title font-weight-bold">List Project</h2>
                    <div class="card bg-card mt-3 mb-5">
                        <div class="card-body">
                            <a href="<?= base_url(); ?>/admin/create_project" class="a-user ">Create Project</a>
                            <!-- <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                                </div>
                            </div> -->
                            <form action="" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
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
                                <div class="alert alert-danger alert-failed " role="alert">
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

                                <?php $no = 0; ?>
                                <?php foreach ($list_project as $u) : ?>
                                    <div class="column">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-6">
                                                    <h6 class="card-subtitle st-ticket text-muted mb-2"><?= $u['idproject']; ?></h6>
                                                    <h6 class="card-subtitle st-ticket text-muted"><?= $u['warantyperiod']; ?></h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="card-subtitle mb-2 st-date text-muted"><?= $u['csnama']; ?></h6>
                                                    <h6 class="card-subtitle st-date text-muted"><?= $u['contractenddate']; ?></h6>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 10px;">
                                            <h5 class="card-title text"><?= $u['namaproject']; ?></h5>
                                            <a href="<?= base_url(); ?>/admin/detail_project/<?= $u['idproject']; ?>" class=" btn-assign">Detail</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <!-- <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted">Id User</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Level</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Username</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Detail</a>
                                    </div>
                                </div> -->






                            </div>
                            <?= $pager->links('users', 'user_pagination') ?>
                            <a href="<?= base_url(); ?>/admin/list_user" title="Back to view all data">
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
        <button class="dropbtn">My Tickets</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/admin/pivot_table_a" class=" <?= ($uri->getSegment(2) == 'pivot_table_a' ? 'active' : null) ?>">Pivot Table</a>
            <a href="<?= base_url(); ?>/admin/sla_chart_a" class=" <?= ($uri->getSegment(2) == 'sla_chart_a' ? 'active' : null) ?>">SLA Chart</a>
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