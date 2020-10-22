<?= $this->extend('pivot_table/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>

    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/v_all_ticket_m" class="btn navbar <?= ($uri->getSegment(2) == 'v_all_ticket_m' ? 'active' : null) ?>">View All Tickets</a>
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="<?= base_url(); ?>/manager/pivot_table" class="btn navbar <?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">Chart</a>
    <a href="<?= base_url(); ?>/manager/sla_chart" class="btn navbar <?= ($uri->getSegment(2) == 'sla_chart' ? 'active' : null) ?>">SLA Chart</a>
</div>


<div class="content" style="height: 617px !important;">
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
                <div style="padding-left:30px;margin-top:15px; ">
                    <?php foreach ($chart as $c) {
                        // Cara masukin nilai ke array
                        $csproduct[] = $c['csproduct'];
                        $jumlah[] = $c['jum'];
                        // Buat kirim data atau pake variabel php di javascript harus pake json_encode($variabel)
                    } ?>
                    <canvas id="myChart" width="200" height="100"></canvas>
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
            <a href="<?= base_url(); ?>/manager/pivot_table" class="<?= ($uri->getSegment(2) == 'pivot_table' ? 'active' : null) ?>">Chart</a>
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

<!-- Chart -->
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($csproduct); ?>,
            datasets: [{
                label: 'Csproduct Chart',
                data: <?= json_encode($jumlah); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


<?= $this->endSection(); ?>