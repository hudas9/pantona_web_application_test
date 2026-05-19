<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - CMS User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/4530e241c6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-input {
            padding-right: 45px;
        }
    </style>
</head>

<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="card shadow-sm w-100" style="max-width: 480px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-1">CMS User</h1>
                </div>

                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Masukkan email anda">
                        <div class="invalid-feedback" id="errorEmail"></div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" class="form-control password-input"
                                placeholder="Masukkan password anda">
                            <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
                        </div>

                    </div>
                    <button type="button" id="loginButton" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
                    $('#loginButton').on('click', login);
                    $('#toggle-toggle').on('click', showHidePassword);

                    function login() {
                        const email = $('#email').val().trim();
                        const password = $('#password').val().trim();

                        if (!email || !password) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: 'Email dan password harus diisi!',
                            });
                            return;
                        }

                        $('#loginButton').prop('disabled', true).text('Memproses...');

                        $.ajax({
                            url: '{{ route('login') }}',
                            method: 'POST',
                            data: {
                                email: email,
                                password: password
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: res.message,
                                }).then(() => {
                                    window.location.href = '/users';
                                });
                            },
                            error: function(xhr) {
                                let message = 'Terjadi kesalahan';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                }

                                console.log(message);
                                $('#email').addClass('is-invalid');
                                $('#errorEmail').text(message);
                            },
                            complete: function() {
                                $('#loginButton').prop('disabled', false).text('Login');
                            }
                        });
                    )
                }
    </script>

</body>

</html>
