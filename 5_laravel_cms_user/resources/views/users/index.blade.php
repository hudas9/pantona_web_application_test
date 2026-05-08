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

    <nav class="navbar bg-body-tertiary border-bottom">
        <div class="container">
            <span class="navbar-brand mb-0 h1">CMS User Manajemen</span>
            <button class="btn btn-danger" id="btnLogout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            $('#btnLogout').on('click', logout);

        });

        function logout() {
            Swal.fire({
                title: 'Logout?',
                text: 'Anda akan keluar dari sistem.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: '{{ route('logout') }}',
                    method: 'POST',
                    success: function() {
                        window.location.href = '{{ route('login') }}';
                    },
                    error: function() {
                        toast('error', 'Terjadi kesalahan saat logout.');
                    }
                });
            });
        }
    </script>

</body>

</html>
