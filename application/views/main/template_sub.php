<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?=$title?></title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>template/css/bootstrap.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>template/datatables.min.css"/>

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?=base_url()?>template/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="<?=base_url()?>template/css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <?php include "header_sub.php"; ?>



  <?php echo $contents; ?>

  <?php include "footer.php"; ?>

  <script type="text/javascript" src="<?=base_url()?>template/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>template/js/bootstrap.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="<?=base_url()?>template/datatables.min.js"></script>
  <script>
    $(document).ready(function () {
        $('.example').DataTable();
    });
  </script>
  <script type="text/javascript" src="<?=base_url()?>template/js/custom.js"></script>

</body>

</html>