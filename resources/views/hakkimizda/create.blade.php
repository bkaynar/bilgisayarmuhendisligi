@extends('adminlayout.master')
@section('title', 'Hakkimizda Ekle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hakkımızda Ekle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Hakkımızda Ekle</h6>
                    <form id="hakkimizdaEkle" method="POST" action="{{ route('hakkimizda-ekle') }}">
                        @csrf
                        <div class="row">
                            <!-- Türkçe İçerik -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icerik_tr" class="form-label">İçerik (Türkçe)</label>
                                    <textarea class="form-control" name="icerik[tr]" id="icerik_tr" rows="10" placeholder="Türkçe içerik giriniz..."></textarea>
                                </div>
                            </div>
                            <!-- İngilizce İçerik -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icerik_en" class="form-label">İçerik (İngilizce)</label>
                                    <textarea class="form-control" name="icerik[en]" id="icerik_en" rows="10" placeholder="İngilizce içerik giriniz..."></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <script src="{{ asset('adminassets/assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('adminassets/assets/js/tinymce.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#hakkimizdaEkle').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('hakkimizda-ekle') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: response.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#hakkimizdaEkle').trigger('reset');
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata',
                                text: response.message,
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: 'Bir hata oluştu.',
                        });
                    }
                });
            });
        });
    </script>
@endpush
