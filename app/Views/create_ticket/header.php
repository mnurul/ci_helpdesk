<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style_create_ticket.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#csproduct").on('change', function() {
                var wperiod = document.getElementById('wperiod');
                var cperiod = document.getElementById('cperiod');
                var idproject = $("#csproduct").val();
                var input = idproject;
                // $.post('<?= base_url(); ?>/user/getCustomer', {
                //     input: input
                // }, function(data) {
                //     // alert(data);
                // });
                // alert("Id " + idproject + input);
                wperiod.value = input;
                cperiod.value = input;
            });
        });
    </script>

</head>

<body>