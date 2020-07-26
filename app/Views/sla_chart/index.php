<?= $this->extend('sla_chart/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>

    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/v_all_ticket_m" class="btn navbar" <?= ($uri->getSegment(2) == 'v_all_ticket_m' ? 'active' : null) ?>>View All Tickets</a>
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/pivot_table" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">Pivot Table</a>
    <a href="<?= base_url(); ?>/manager/sla_chart" class="btn navbar <?= ($uri->getSegment(2) == 'sla_chart' ? 'active' : null) ?>">SLA Chart</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-manager"><b>Welcome <?= session()->get('username'); ?></b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-manager.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">SLA Chart</h2>
                    <div class="container mt-3">
                        <div class="row mb-2" style="height:300px">
                            <div class="col card card1 mr-2">
                                <h1>Diagram satu</h1>
                            </div>
                            <div class="col card card2">
                                <h1>Diagram dua</h1>
                            </div>
                        </div>
                        <div class="row" style="height:300px">
                            <div class="col card">
                                <h1>Diagram tiga</h1>
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
        <a href="<?= base_url(); ?>/manager/v_all_ticket_m">View All Tickets</a>
    </div>
</div>
<div class="dropup">
    <button class="dropbtn">View Report</button>
    <div class="dropup-content">
        <a href="<?= base_url(); ?>/manager/pivot_table">Pivot Table</a>
        <a href="<?= base_url(); ?>/manager/sla_chart">SLA Chart</a>
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