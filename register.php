<?php
session_start();
include('config.php');
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Username cannot be blank";
  } else {
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      // Set the value of param username
      $param_username = trim($_POST['username']);
      // Try to execute this statement
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "This username is already taken";
          $_SESSION['message'] = "This username is already taken";

        } else {
          $username = trim($_POST['username']);
        }
      } else {
        echo "Something went wrong";
      }
    }
  }

  mysqli_stmt_close($stmt);


  // Check for password
  if (empty(trim($_POST['password']))) {
    $password_err = "Password cannot be blank";
    $_SESSION['message'] = "Password cannot be blank";
  } elseif (strlen(trim($_POST['password'])) < 5) {
    $password_err = "Password cannot be less than 5 characters";
    $_SESSION['message'] = "Password cannot be less than 5 characters";
  } else {
    $password = trim($_POST['password']);
  }

  // Check for confirm password field
  if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
    $password_err = "Passwords should match";
    $_SESSION['message'] = "Passwords should match";
  }


  // If there were no errors, go ahead and insert into the database
  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Set these parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      // Try to execute the query
      if (mysqli_stmt_execute($stmt)) {
        header("location: login.php");
      } else {
        echo "Something went wrong... cannot redirect!";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

?>




<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- alertify js -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <!-- bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

  <title>PHP Ecommerce</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">PHP Ecom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Collections</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>



      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    <?php
    if (isset($_SESSION['message'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Hey!</strong>
      <?= $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
      unset($_SESSION['message']);
    }
    ?>
    <h3>Please Register Here:</h3>
    <hr>
    <form action="" method="post" id="dropdowns">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputName4">Username</label>
          <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Enter Username">
        </div>

        <div class="form-group col-md-6">
          <label for="inputPassword4">Password</label>
          <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
        </div>
        <div id="showErrorPwd"></div>
      </div>
      <div class="form-group">
        <label for="inputPassword4">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" id="inputPassword"
          placeholder="Confirm Password">
      </div>
      <div id="showErrorcPwd"></div>
      <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Street Address">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputState">State</label>
          <!-- <input type="text" class="form-control" id="state"> -->
          <select id="states" name="states" class="form-control">
            <!-- <option selected>Choose</option> -->
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputDistrict">District</label>
          <!-- <input type="text" class="form-control" id="district"> -->
          <select id="districts" name="districts" class="form-control ">
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck" required="required">
          <label class="form-check-label" for="gridCheck">
            Check me out
          </label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>





    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- <script src="js/custom.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
      integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js"
      integrity="sha512-5BqtYqlWfJemW5+v+TZUs22uigI8tXeVah5S/1Z6qBLVO7gakAOtkOzUtgq6dsIo5c0NJdmGPs0H9I+2OHUHVQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="custom.php"></script>
    <!-- alertify js -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <!-- Not working  -->
    <script>
      alertify.set('notifier', 'position', 'top-right');
    <?php if (isset($_SESSION[' message '])) { ?>

        alertify.success('<?= $_SESSION[' message ']; ?>');
    <?php
      unset($_SESSION[' message ']);
      } ?>
    </script>

    <script>
        $(document).ready(function () {

          $('#inputPassword').keyup(function () {
            var pwd = $('#inputPassword4').val();
            var cpwd = $('#inputPassword').val();
            if (cpwd != pwd) {
              $('#showErrorcPwd').html('*Password is not matching*');
              $('#showErrorcPwd').css('color', 'red');
              return false;
            }
            else {
              $('#showErrorcPwd').html('*Password  matched*');
              $('#showErrorcPwd').css('color', 'green');
              return true;
            }
          });
        });
    </script>

    <script>
      $("[name='username']").prop("required", true);
      $("[name='password']").attr("required", true);
      $("[name='confirm_password']").attr("required", true);
    </script>



    <!-- *************************************** -->
    <script>
      $(function () {
        var stateOptions;
        stateOptions = `<option val="" selected disabled> Select State</option>`

        var districtOptions;
        districtOptions = `<option val="" selected disabled> Select District</option>`
        $.getJSON('IndianStatesDistricts.json', function (result) {
          $.each(result.states, function (i, states) {
            stateOptions += `<option value='${states.code}'> ${states.name}</option>`;
          });
          $('#states').html(stateOptions);
        });

        $("#states").change(function () {
          $state_code = $('#states').val();
          // **********************************
          console.log($state_code);
          // console.log("wait");
          $("#districts").empty();
          // $('.districtname').empty();
          // $(document).ready(function () {
          //   $('#states').click(function () {
          //     $('#districts').empty();
          //   });
          // });
          // **********************************
          $.getJSON('IndianStatesDistricts.json', function (result) {
            console.log(result.states);
            var districtOptions = "";
            districtOptions = `<option val="" selected disabled> Select District</option>`
            $.each(result.states, function (i, districts) {
              // $district_code = districts.code;
              // console.log($district_code);
              if ($state_code === districts.code) {
                // console.log(districts.districts);
                $dis = districts.districts;
                $.each($dis, function (id, name) {
                  // console.log(name);
                  districtOptions += `<option value='${id}'> ${name.name}</option>`;
                });
              }
            });
            $('#districts').html(districtOptions);
          });
        });
      });
    </script>

</body>

</html>