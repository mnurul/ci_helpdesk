<?= $this->extend('my_assigment_a/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/admin/my_request" class="active btn navbar">My Request</a>
    <a href="<?= base_url(); ?>/admin/my_assigment_a" class=" btn navbar">My Assigment</a>
    <a href="<?= base_url(); ?>/admin/my_resolution" class=" btn navbar">My Resolution</a>
    <a href="#contact" class=" btn navbar">Waiting for Close</a>
    <a href="#contact" class=" btn navbar">View All Tickets</a>
    <a href="#contact" class=" btn navbar">Popular Solution</a>
    <a href="#contact" class=" btn navbar">Search Tickets</a>
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="#contact" class="active btn navbar">Pivot Table</a>
    <a href="#contact" class="btn navbar">SLA Chart</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-admin"><b>Welcome Admin</b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-manager.png" class="logo" alt="" loading="lazy">
                    <a href="#contact">Logout</a>
                    <a href="#contact">Change Status Tickets</a>
                    <a href="#contact">Create Projects</a>
                    <a href="#contact">Create User</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">My Assigment</h2>
                    <div class="card bg-card mt-3 mb-5">
                        <div class="card-body">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
                            <div class="row">
                                <div class="column">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-6">
                                                <h6 class="card-subtitle st-ticket text-muted">No. Ticket</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-subtitle mb-2 st-date text-muted">Reported Date</h6>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Assign</a>
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
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Assign</a>
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
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Assign</a>
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
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Assign</a>
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
                                            </div>
                                        </div>
                                        <hr style="margin-top: 10px;">
                                        <h5 class="card-title text">Promblem Summary</h5>
                                        <a href="<?= base_url(); ?>/admin/form_assigment_a" class=" btn-assign">Assign</a>
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
        <button class="dropbtn">View Report</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/manager/pivot_table">Pivot Table</a>
            <a href="<?= base_url(); ?>/manager/sla_chart">SLA Chart</a>
        </div>
    </div>
    <div class="col-6" style="margin-left:-15px;">

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