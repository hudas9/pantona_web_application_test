<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - CMS User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/4530e241c6.js" crossorigin="anonymous"></script>
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

    <div class="container mt-4">
        <div class="table-responsive">
            <table id="tableUser" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center" style="width:220px;">Foto Profil</th>
                        <th class="text-center" style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        let tableUser;

        $(function() {
            tableUser = $('#tableUser').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.datatable') }}',
                lengthChange: false,
                language: {
                    search: 'Cari:',
                    info: 'Menampilkan _START_-_END_ dari _TOTAL_ user',
                    infoEmpty: 'Tidak ada data',
                    emptyTable: 'Belum ada user terdaftar.',
                    zeroRecords: 'Tidak ada user yang cocok.',
                    processing: 'Memuat data...',
                },
                columns: [{
                        data: 'email',
                        name: 'email',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        className: 'text-center'
                    },
                ],
            });

            $('#btnLogout').on('click', logout);
        });

        function toast(icon, title) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        }

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
