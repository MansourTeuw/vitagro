<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    // $system = $conn->query("SELECT * FROM sys_settings")->fetch_array();
    // foreach($system as $k => $v){
    //   $_SESSION['system'][$k] = $v;
    // }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>
<body class="hold-transition login-page bg-black">
<div class="login-box" style="border: 3px dotted white; width:fit-content; padding: 15px;">
  <div class="login-logo">
    <img src="img/vitagro.png" alt="" width="50%" height="70%" style="margin-bottom: 20px;">
    <center>
      <marquee behavior="" direction="">Système de Gestion Automatisée des Parcelles.</marquee>
    </center>
  </div>
  <!-- /.login-logo -->
  <div class="card" style="width: 600px;">
    <div class="card-body login-card-body" >
      <form action="" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Mot de Passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Se souvenir de moi
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">

            <button type="submit" class="btn btn-primary btn-block btn-sm">Sign In</button>
            <button type="reset" class="btn btn-danger btn-block btn-sm">Vider</button>

          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Mot de Passe ou Identifiant Incorrect!</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
