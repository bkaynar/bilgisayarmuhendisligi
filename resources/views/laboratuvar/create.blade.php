@extends('adminlayout.master')
@section('title', 'Laboratuvar Ekle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laboratuvar Ekle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Laboratuvar Ekle</h6>
                    <form id="laboratuvarEkle" method="POST" action="{{ route('laboratuvar.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="lab_resim" class="form-label">Laboratuvar Resmi</label>
                                    <input type="file" class="form-control" name="lab_resim" id="lab_resim" required>
                                </div>
                            </div>
                        </div>

                        <!-- Sekme Menüsü -->
                        <ul class="nav nav-tabs" id="langTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tr-tab" data-bs-toggle="tab" href="#tr" role="tab"
                                   aria-controls="tr" aria-selected="true">Türkçe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab"
                                   aria-controls="en"
                                   aria-selected="false">İngilizce</a>
                            </li>
                        </ul>

                        <!-- Sekme İçerikleri -->
                        <div class="tab-content border border-top-0 p-3 mb-3" id="langTabContent">
                            <!-- Türkçe İçerik -->
                            <div class="tab-pane fade show active" id="tr" role="tabpanel" aria-labelledby="tr-tab">
                                <input type="hidden" name="translations[0][locale]" value="tr">
                                <div class="mb-3">
                                    <label for="lab_ad_tr" class="form-label">Laboratuvar Adı</label>
                                    <input type="text" class="form-control" name="translations[0][lab_ad]"
                                           id="lab_ad_tr" placeholder="Laboratuvar Adı (Türkçe)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lab_aciklama_tr" class="form-label">Laboratuvar Açıklaması</label>
                                    <textarea class="form-control tinymce-editor"
                                              name="translations[0][lab_aciklama]"
                                              id="lab_aciklama_tr" rows="10"
                                              placeholder="Laboratuvar açıklaması (Türkçe)"></textarea>
                                </div>
                            </div>

                            <!-- İngilizce İçerik -->
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <input type="hidden" name="translations[1][locale]" value="en">
                                <div class="mb-3">
                                    <label for="lab_ad_en" class="form-label">Laboratory Name</label>
                                    <input type="text" class="form-control" name="translations[1][lab_ad]"
                                           id="lab_ad_en" placeholder="Laboratory Name (English)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lab_aciklama_en" class="form-label">Laboratory Description</label>
                                    <textarea class="form-control tinymce-editor"
                                              name="translations[1][lab_aciklama]"
                                              id="lab_aciklama_en" rows="10"
                                              placeholder="Laboratory description (English)"></textarea>
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
            $('#laboratuvarEkle').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('laboratuvar.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: response.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('laboratuvar.index') }}";
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
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        for (let field in errors) {
                            errorMessage += errors[field][0] + '<br>';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Doğrulama Hatası',
                            html: errorMessage,
                        });
                    }
                });
            });
        });
    </script>
@endpush
