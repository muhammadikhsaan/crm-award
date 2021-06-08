<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="in" dir="ltr">
  <head>
    <meta http-equiv="Content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TELKOM INDONESIA</title>
    <link rel="stylesheet" href="<?php echo base_url('../script/css/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('../script/css/self/login.min.css') ?>">
  </head>
  <body>
    <main style="margin-top:60px">
      <div class="login-title">
        <font>DASHBOARD</font>
        <font>PERFORMANCE REWARD</font>
      </div>
      <div class="login-form-wrap">
        <form action="<?= base_url('s/import') ?>" method="get" enctype="application/x-www-form-urlencoded">
          <h5 style="text-align:center">Update Data</h5>
          <div class="input-wrap" style="background-color:rgba(220,220,220); border-color:black">
            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" name="date">
          </div>
          <div class="submit-wrap" style="float:right; margin-top:20px;">
            <button type='submit' name="action" value='update' style="padding:7px 10px 3px 10px!important; color:white; background-color:royalblue;">Update Data</button>
            <button type='submit' name="action" value='get' style="padding:7px 10px 3px 10px!important; color:white; background-color:seagreen;">Ambil Data</button>
          </div>
        </form>
      </div>
      <div class="legalitas">
        <h5>2019 &copy; PT. Telekomunikasi Indonesia Tbk.</h5>
      </div>
    </main>
  </body>
  <script type="text/javascript">
    <?php if (!empty($errors['errors'])):  ?>
      alert('<?= $errors['errors'] ?>');
    <?php endif; ?>
  </script>
</html>
