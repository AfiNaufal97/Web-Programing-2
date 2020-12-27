<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Halaman Login</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body>


    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center mt-0 m-b-15">
                    Silahkan Login
                </h3>

                <div class="p-3">
                    <?= form_open('login/cekuser', ['class' => 'formlogin']) ?>
                    <?= csrf_field() ?>
                    <form class="form-horizontal m-t-20" action="index.html">

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" placeholder="Username" id="userid" name="userid" autofocus>
                                <div class="invalid-feedback errorUserID"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" placeholder="Password" id="pass" name="pass">
                                <div class="invalid-feedback errorPassword"></div>
                            </div>
                        </div>


                        <div class="form-group text-center row m-t-20">
                            <div class="col-12">
                                <button class="btn btn-danger btn-block waves-effect waves-light btnlogin" type="submit">Log In</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/modernizr.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/jquery.slimscroll.js"></script>
    <script src="/assets/js/jquery.nicescroll.js"></script>
    <script src="/assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script>
        $(document).ready(function() {
            $('.formlogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnlogin').prop('disable', true);
                    },
                    complete: function() {
                        $('.btnlogin').prop('disable', false);
                        // $('.btnlogin').html("");
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.userid) {
                                $('#userid').addClass('is-invalid');
                                $('.errorUserID').html(response.error.userid);
                            } else {
                                $('#userid').removeClass('is-invalid');
                                $('.errorUserID').html('');
                            }

                            if (response.error.pass) {
                                $('#pass').addClass('is-invalid');
                                $('.errorPassword').html(response.error.pass);
                            } else {
                                $('#pass').removeClass('is-invalid');
                                $('.errorPassword').html('');
                            }

                        }
                        if(response.sukses){
                            window.location = response.sukses.link;
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false
            });

        });
    </script>

</body>

</html>