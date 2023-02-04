<!doctype html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task</title>


    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.css" type="text/css">


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css"> -->

</head>

    <?php
        session_start();
        // var_dump($_SESSION);
    ?>
<body>
    <header>
        <div class="login">
            <?php if(isset($_SESSION['user'])){ ?>
                <span onclick="logout()">Logout</span>
            <?php }else{ ?>
                <span data-toggle="modal" data-target="#login">Login</span>
            <?php } ?>
        </div>
    </header>
    <div class="content">
        <?php if(isset($_SESSION['user'])){ ?>
            <h4>Name: <?php echo $_SESSION["user"]["f_name"]." ".$_SESSION["user"]["l_name"] ?></h4>
        <?php } ?>
    </div>



    <!-- Modal Login-->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body">
            <div class="pa_form">
                <h1>Login</h1>
                <div class="my_form">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="email_login" aria-describedby="emailHelp" placeholder="email@email.com">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" id="pass_login" aria-describedby="emailHelp" placeholder="password">
                    </div>
                    <span class="error_login"></span>
                    <button type="submit" id="login_but" class="btn btn-primary">Login</button>
                    <button type="submit" id="register_info" class="btn btn-primary">Register</button>
                    <div class="min_info"> <span id="forgot_password_info">Forgot password</span>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>

    <!-- Modal Registration-->
    <div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body">
            <div class="pa_form">
                <h1>Registration</h1>
                <div class="my_form">
                     <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" name="f_name" class="form-control" id="f_name" aria-describedby="emailHelp" placeholder="First Name">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" name="l_name" class="form-control" id="l_name" aria-describedby="emailHelp" placeholder="Last Name">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="email_reg" aria-describedby="emailHelp" placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="pass" class="form-control" id="pass_reg" aria-describedby="emailHelp" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Repeat password</label>
                        <input type="password" name="pass2" class="form-control" id="pass2_reg" aria-describedby="emailHelp" placeholder="Repeat password">
                    </div>
                    <span class="error_reg"></span>
                    <button type="submit" id="register_but" class="btn btn-primary">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>

    <!-- Modal Registration Success-->
    <div class="modal fade" id="registration_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> -->
                <div class="modal-body">
                    <div class="pa_form">
                        <h1>Registration Success</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Forgot password-->
    <div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body">
            <div class="pa_form">
                <h1>Forget Password</h1>
                <div class="my_form">
                    <div class="email_block">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="email_forgot" aria-describedby="emailHelp" placeholder="email">
                    </div>
                    <span class="forgot_error"></span>
                    <button type="submit" id="forget_but" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal Forgot passkey-->
    <div class="modal fade" id="forgot_passkey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body">
            <div class="pa_form">
                <h1>We send code to your mail</h1>
                <div class="my_form">
                    <div class="email_block">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Code</label>
                        <input type="text" class="form-control" id="pass_key" aria-describedby="passKeyHelp" placeholder="Code">
                    </div>
                    <span class="forgot_key_error"></span>
                    <button type="submit" id="forget_key" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal New Password-->
<div class="modal fade" id="new_passkey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
            <div class="modal-body">
                <div class="pa_form">
                    <h1>New Password</h1>
                    <div class="my_form">
                        <div class="email_block">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="pass" class="form-control" id="pass_rep" aria-describedby="emailHelp" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Repeat password</label>
                                <input type="password" name="pass2" class="form-control" id="pass2_rep" aria-describedby="emailHelp" placeholder="Repeat password">
                            </div>
                            <span class="new_pass_error"></span>
                            <button type="submit" id="new_pass_but" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Password Success-->
    <div class="modal fade" id="password_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> -->
                <div class="modal-body">
                    <div class="pa_form">
                        <h1>Password changed</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


</html>