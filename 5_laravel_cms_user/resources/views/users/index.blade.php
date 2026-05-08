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
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="h4 mb-0">Daftar User</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa-solid fa-plus"></i> Tambah User
            </button>
        </div>

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

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                        <i class="fa-solid fa-user-plus me-1"></i> Tambah User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAddUser">
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="addEmail" name="email"
                                placeholder="email@contoh.com">
                            <div class="invalid-feedback" id="errorAddEmail"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addNama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="addNama" name="nama"
                                placeholder="Masukkan nama lengkap">
                            <div class="invalid-feedback" id="errorAddNama"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="addPassword" name="password"
                                placeholder="Min. 6 karakter">
                            <div class="invalid-feedback" id="errorAddPassword"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addImage" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="addImage" name="image_profile"
                                accept="image/jpeg,image/png,image/jpg,image/webp">
                            <div class="invalid-feedback" id="errorAddImage"></div>
                        </div>
                        <div id="addImagePreview" class="mb-2 d-none">
                            <p class="fw-semibold small mb-1">Preview:</p>
                            <img id="addPreviewImg" src="" alt="preview" class="img-thumbnail"
                                style="width:150px;height:150px;object-fit:cover;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitAdd">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditUser">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email <span class="text-muted"
                                    style="font-size:0.85rem;">(tidak dapat diubah)</span></label>
                            <input type="email" class="form-control" id="editEmail" readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editNama" name="nama"
                                placeholder="Masukkan nama lengkap">
                            <div class="invalid-feedback" id="errorEditNama"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password <span class="text-muted"
                                    style="font-size:0.85rem;">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" class="form-control" id="editPassword" name="password"
                                placeholder="Password baru (opsional)">
                            <div class="invalid-feedback" id="errorEditPassword"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Foto Profil <span class="text-muted"
                                    style="font-size:0.85rem;">(kosongkan jika tidak diubah)</span></label>
                            <input type="file" class="form-control" id="editImage" name="image_profile"
                                accept="image/jpeg,image/png,image/jpg,image/webp">
                            <div class="invalid-feedback" id="errorEditImage"></div>
                        </div>
                        <div id="editImagePreview" class="mb-2">
                            <p class="fw-semibold small mb-1">Foto Saat Ini:</p>
                            <img id="editPreviewImg" src="" alt="preview" class="img-thumbnail"
                                style="width:150px;height:150px;object-fit:cover;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitEdit">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let tableUser;
        const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
        const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));

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
                        data: 'nama',
                        name: 'nama',
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

            $('#addImage').on('change', function() {
                previewImage(this, '#addPreviewImg', '#addImagePreview');
            });

            $('#editImage').on('change', function() {
                previewImage(this, '#editPreviewImg', '#editImagePreview');
            });

            document.getElementById('addUserModal').addEventListener('show.bs.modal', clearAddForm);

            $('#btnSubmitAdd').on('click', submitAddUser);

            $('#tableUser').on('click', '.btn-edit', openEditModal);

            $('#btnSubmitEdit').on('click', submitEditUser);

            $('#tableUser').on('click', '.btn-delete', deleteUser);
        });

        function submitAddUser() {
            clearErrors('Add');

            const nama = $('#addNama').val().trim();
            const email = $('#addEmail').val().trim();
            const password = $('#addPassword').val();

            const formData = new FormData();
            formData.append('nama', nama);
            formData.append('email', email);
            formData.append('password', password);
            if ($('#addImage')[0].files[0]) {
                formData.append('image_profile', $('#addImage')[0].files[0]);
            }

            const $btn = $('#btnSubmitAdd').prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: '{{ route('users.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    addUserModal.hide();
                    tableUser.ajax.reload(null, false);
                    toast('success', res.message);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        displayErrors(xhr.responseJSON.errors, 'Add');
                    } else {
                        toast('error', xhr.responseJSON?.message || 'Gagal menambah user.');
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Simpan');
                }
            });
        }

        function openEditModal() {
            const $btn = $(this);
            const userId = $btn.data('id');
            const userEmail = $btn.data('email');
            const userName = $btn.data('name');
            const userImage = $btn.data('image');

            $('#editUserId').val(userId);
            $('#editEmail').val(userEmail);
            $('#editNama').val(userName);
            $('#editPassword').val('');
            $('#editImage').val('');
            $('#editPreviewImg').attr('src', userImage);

            clearErrors('Edit');
            editUserModal.show();
        }

        function submitEditUser() {
            clearErrors('Edit');

            const userId = $('#editUserId').val();
            const nama = $('#editNama').val().trim();
            const password = $('#editPassword').val();

            const formData = new FormData();
            formData.append('nama', nama);
            if (password) {
                formData.append('password', password);
            }
            if ($('#editImage')[0].files[0]) {
                formData.append('image_profile', $('#editImage')[0].files[0]);
            }
            formData.append('_method', 'PUT');

            const $btn = $('#btnSubmitEdit').prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: '/users/' + userId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    editUserModal.hide();
                    tableUser.ajax.reload(null, false);
                    toast('success', res.message);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        displayErrors(xhr.responseJSON.errors, 'Edit');
                    } else {
                        toast('error', xhr.responseJSON?.message || 'Gagal mengubah user.');
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Simpan Perubahan');
                }
            });
        }

        function deleteUser() {
            const userId = $(this).data('id');

            Swal.fire({
                title: 'Hapus User?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: '/users/' + userId,
                    method: 'DELETE',
                    success: function(res) {
                        tableUser.ajax.reload(null, false);
                        toast('success', res.message);
                    },
                    error: function(xhr) {
                        toast('error', xhr.responseJSON?.message || 'Gagal menghapus user.');
                    }
                });
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

        function previewImage(input, imgSelector, previewSelector) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    $(imgSelector).attr('src', e.target.result);
                    $(previewSelector).removeClass('d-none');
                };
                reader.readAsDataURL(file);
            }
        }

        function displayErrors(errors, prefix) {
            const fieldMap = {
                nama: 'Nama',
                email: 'Email',
                password: 'Password',
                image_profile: 'Image'
            };

            $.each(errors, function(field, messages) {
                const suffix = fieldMap[field] || (field.charAt(0).toUpperCase() + field.slice(1));
                const inputId = '#' + prefix.toLowerCase() + suffix;
                const errorId = '#error' + prefix + suffix;
                $(inputId).addClass('is-invalid');
                $(errorId).text(messages[0]);
            });
        }

        function clearErrors(prefix) {
            const fields = ['Nama', 'Email', 'Password', 'Image'];
            fields.forEach(field => {
                const inputId = '#' + prefix.toLowerCase() + field;
                const errorId = '#error' + prefix + field;
                $(inputId).removeClass('is-invalid');
                $(errorId).text('');
            });
        }

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

        function clearAddForm() {
            $('#addNama, #addEmail, #addPassword').val('');
            $('#addImage').val('');
            $('#addImagePreview').addClass('d-none');
            $('#addPreviewImg').attr('src', '');
            clearErrors('Add');
        }
    </script>

</body>

</html>
