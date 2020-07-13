<?= $this->extend('w_for_close/template'); ?>

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
                    <a href="#contact">Logout</a>
                    <!-- <a href="<?= base_url(); ?>/admin/change_status">Change Status Tickets</a> -->
                    <!-- <a href="<?= base_url(); ?>/admin/create_project">Create Projects</a> -->
                    <a href="<?= base_url(); ?>/admin/list_user">Users</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">Waiting for Close</h2>
                    <div class="card bg-card mt-3 mb-5">
                        <div class="card-body">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
                            <div class="row">
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">No. Ticket</h6>
                                                <h6 class="card-subtitle st-ticket text-muted">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported By</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Urgency</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_w_for_close" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">No. Ticket</h6>
                                                <h6 class="card-subtitle st-ticket text-muted">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported By</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Urgency</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_w_for_close" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">No. Ticket</h6>
                                                <h6 class="card-subtitle st-ticket text-muted">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported By</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Urgency</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_w_for_close" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">No. Ticket</h6>
                                                <h6 class="card-subtitle st-ticket text-muted">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported By</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Urgency</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_w_for_close" class=" btn-assign">Detail</a>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted mb-2">No. Ticket</h6>
                                                <h6 class="card-subtitle st-ticket text-muted">Customer</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported By</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Urgency</h5>
                                        <a href="<?= base_url(); ?>/admin/detail_w_for_close" class=" btn-assign">Detail</a>
                                    </div>
                                </div>






                            </div>
                            <div class="pagination justify-content-center ">
                                <a href="#">&laquo;</a>
                                <a href="#">1</a>
                                <a class="active" href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <a href="#">&raquo;</a>
                            </div>
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