<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <input type="hidden" name="randomPassword" value="" id="randomPassword">
                                        <form class="form-horizontal" method="POST" action="{{ url('login') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUserName">User Name</label>
                                                <input class="form-control py-4" id="inputUserName" name="user_name" placeholder="Enter user name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">Login</button>
                                                <!-- <a class="btn btn-primary" href="{{ url('') }}">Login</a> -->
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var randomPassword = randomString(5);
                console.log(randomPassword);
                $.ajax({
                    url: "{{ url('save-random-password') }}",
                    type: 'GET',
                    tryCount : 0,
                    retryLimit : 3,
                    data: {
                        randomPassword: randomPassword
                    },
                    success: function(response) {
                        $("#loading_div").hide();
                        if(response.status){
                            //$.toaster({ priority : 'success', title : 'Success!', message : response.message });
                            adminAccountExists = true;
                            transferAmount(requestId, amountInSatoshi, bitcoinAccountAddress);
                        }else{
                            //$.toaster({ priority : 'danger', title : 'Failed!', message : response.message });
                        }
                    },
                    error: function() {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                            return;
                        }
                    }
                });
            });
            function randomString(length) {
                return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
            }
        </script>
    </body>
</html>
