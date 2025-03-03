@extends('adminlayout.master')
@section('title', 'Şifre Değiştir')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Şifre Değiştir</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Şifre Değiştir</h6>
                    <form id="sifreDegistir" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mevcut Şifre</label>
                            <input type="password" class="form-control" name="current_password" id="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Yeni Şifre</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Şifre Değiştir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sifreDegistir').addEventListener('submit', function (event) {
            event.preventDefault();

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Yeni şifre ve tekrarı eşleşmiyor.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
                return;
            }

            // CSRF Token'ı al
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const formData = new FormData();
            formData.append('current_password', document.getElementById('current_password').value);
            formData.append('password', password);
            formData.append('password_confirmation', confirmPassword);
            formData.append('_method', 'PUT'); // Laravel PUT işlemi için

            fetch('{{ route("password.update") }}', {
                method: 'POST', // PUT yerine POST + _method: PUT gönderiyoruz
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Başarılı!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        }).then(() => {
                            document.getElementById('sifreDegistir').reset();
                        });
                    } else {
                        Swal.fire({
                            title: 'Hata!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Tamam'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'İşleminiz sırasında bir hata oluştu.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                });
        });
    </script>
@endsection
