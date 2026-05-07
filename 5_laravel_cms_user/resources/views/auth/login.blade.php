<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - CMS User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="card shadow-sm w-100" style="max-width: 480px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-1">CMS User</h1>
                </div>

                <form id="loginForm" onsubmit="event.preventDefault(); login();">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Masukkan email anda">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan password anda">
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="login()">
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

            $('button').prop('disabled', true).text('Memproses...');

            $.ajax({
                url: '/login',
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: message,
                    });
                }
            });
        }
    </script>

</body>

</html>
