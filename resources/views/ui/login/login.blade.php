<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/style.css') }}">
    <!-- Title and favicon -->
    <title>Rent-login</title>
    <link rel="icon" type="image/png" href="{{ asset('ui/login_assets/images/favicon.png') }}" />
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('ui/login_assets/images/favicon.png') }}"> --}}
</head>

<body>
    {{-- <img src="{{ asset('ui/login_assets/images/login.png') }}"> --}}
    <div class="login_page">
        <div class="alert_message">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0rem;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success" role="success">
                {{ Session::get('success') }}
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger" role="success">
                {{ Session::get('error') }}
            </div>
            @endif
        </div>
        <div class="login_form">
            <div class="login_title text-center">
                <h3>Rent</h3>
                <p>Member Login</p>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="login_page">
                    <form action="/userLogin" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="user_email" name="user_email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-flex flex-row-reverse forgotPass">
                            <p>Forgot Password?</p>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-block btn-warning">Login</button>
                        </div>
                    </form>
                    <div id="signUp" class=" mt-4 signUp d-flex justify-content-center">
                        <p >Create New Account</p>
                    </div>
                </div>

                <div class="tab-pane" id="register_page">
                    
                </div>

                <div class="tab-pane" id="forgot_pass">
                    <form action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email_phone" class="form-label">Email/Phone</label>
                            <input type="text" class="form-control" id="email_phone" name="email_phone" required>
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Input Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close">&times;</span>
            </div>
            <div>
                <h4 class=" mb-3">Member Registration</h4>
                <form action="/registration" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Contact Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="userType" name="userType">
                            <option selected disabled value="">User Type</option>
                            <option value="1">Landlord</option>
                            <option value="0">Tenent</option>
                        </select>
                    </div>	
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-warning">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('ui/login_assets/js/custom.js') }}"></script>
</body>

</html>
