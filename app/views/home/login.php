
	<?php require APPROOT . '/views/home/inc/header.php'; ?>
  <?php require APPROOT . '/views/home/inc/navbar.php'; ?>
  <div class="login-box">
      <div class="login-logo">
        <a href=""><b>GLOWHMS</b> </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="messages">
        <?php echo $data['alert']; ?>
   </div>
        <form role="form" method="post" action="<?php echo URLROOT; ?>/home/login" enctype="multipart/form-data">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="User Id" name="user"  id="user">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
             <span class="disperr" style="color: red;"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="disperr" style="color: red;"><?php echo $data['password_err']; ?></span>
          </div>
          
            <div class="col-sm-4 ">
              <button type="submit" class="btn btn-primary btn-block btn-flat center-block">Sign In</button>
            </div><!-- /.col -->
          
        </form>

      

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

<?php require APPROOT . '/views/home/inc/footer.php'; ?>

</body>
</html>
<!-- FOOTER -->


