<?php session_start(); ?>
<?php include 'header.php'; ?>

<style>
  .login-page, .register-page{
    background-color: #dd4b39;
  }
    .logo{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    }
  body{
    padding-top: 1.5px;
  }
  .login-box p{
    font-size: 25px;
  }
  .login-box b{
    font-size: 25px;
  }
  .login-admin{
    text-align: right;
    padding-right: 20px;
    padding-bottom: 5px;
  }
  .login-admin a{
  }
.login-admin a:hover{
    color: black;
    text-decoration: underline;
}
</style>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
      <b>Presensi Karyawan</b>
  		<p id="date" class="bold"></p>
      <p id="time" class="bold"></p>
  	</div>
    <img src="
    images/oke.png" class=logo>
    <br></br>
  	<div class="login-box-body">
    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Jam Masuk</option>
              <option value="out">Jam Keluar</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" id="employee" name="employee" placeholder="Kode Karyawan"required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat " name="signin"><i class="fa fa-sign-in"></i> OK</button>
        	</div>
          <div class="col-xs-1"></div>
            <div class="login-admin">
              <a href="admin/index.php"><br>Masuk sebagai Admin</a>
          </div>
      	</div>
    	</form>
  	</div>


		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
</div>

<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('DD MMMM YYYY'));
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });

});
</script>
</body>
</html>
