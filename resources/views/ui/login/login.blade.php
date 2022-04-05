<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/style.css') }}">
    <!-- Title and favicon -->
    <title>Rent-login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('ui/login_assets/images/favicon.png') }}">
  </head>
  <body>
    <img src="{{ asset('ui/login_assets/images/login.png') }}">
      <div class="login_page">        
          <div class="login_form">
            <div class="nav_bar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" id="client1" data-bs-toggle="tab"
                            href="#login_page">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="more1" data-bs-toggle="tab"
                            href="#register_page">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="social1" data-bs-toggle="tab"
                            href="#forgot_pass">Forgot Password</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="login_page">
                    <form action="">
                        <div class="mb-3">
                            <label for="email_phone" class="form-label">Email/Phone</label>
                            <input type="text" class="form-control" id="email_phone" name="email_phone">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-warning">Login</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="register_page">
                    <form action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="re_password" name="re_password">
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-warning">Register</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="forgot_pass">
                    <form action="">
                        <div class="mb-3">
                            <label for="email_phone" class="form-label">Email/Phone</label>
                            <input type="text" class="form-control" id="email_phone" name="email_phone">
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('ui/login_assets/js/custom.js') }}"></script>
  </body>
</html>