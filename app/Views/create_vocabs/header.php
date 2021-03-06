<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style_create_vocabs.css">
    <!-- <script src="//code.jquery.com/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/savy/savy.min.js"></script>
    <title>Create Word </title>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#level").on('change', function() {
                var idcustomer = document.getElementById('idcustomer');

                if (level = $("#level").val() != 'customer') {
                    document.getElementById("idcustomer").disabled = true;
                } else {
                    document.getElementById("idcustomer").disabled = false;
                }
            });
        });
    </script>
</head>

<body>