## Buat aplikasi register & login user sederhana, spesifikasinya

1. Buat 1 page untuk CMS user, dimana di page tersebut memiliki spesifikasi sebagaiberikut
A. System bisa membuat user dengan data
    - Email (Unique tidak boleh sama dengan user lain)
    - Nama
    - Password (Tidak bolehkosong)
    - Input image dari file untuk image profile
B. System dapat menampilkan list user yang ter registrasi (Email, Nama,Image tampilkan gambarnya ukuran 200px x 200px) menggunakan “Jquery Datatable”, wajib menggunakan model server side datatable, paginaition per 10 data
C. System dapat menghapus user dari list user
D.System dapat merubah data user di user list (data nama, password dan imageprofile)

2. Buat page untuk login user, munculkan cukup input email, password dan tombol login, ketika tombol login di klik (jika user ada dan password sesuai langsung di redirect ke halaman List user, jika gagal munculkan pesan gagalnya)

Untuk UI nya bebas menggunakn bootstrap atau sejenisnya, tapi untuk pembuatan featurenya dilarang menggunakan liblary CMS generator, harus murni bikin sendiri, untuk frameworknya harus menggunakan CodeIgniter/Laravel, untuk menyimpan datanya harus ke database, designya dibuat sendiri. Untuk Proses Create, Update, Delete dan Login wajib menggunakan Ajaxrequest, JANGAN menggunakan form submit.
