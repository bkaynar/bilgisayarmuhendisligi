@extends('adminlayout.master')
@section('title', 'Akademik Personel Ekle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akademik Personel Ekle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Akademik Personel Ekle</h6>
                    <form id="personelEkle" method="POST" action="{{ route('akademikEkle') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="personel_isim_soyisim" class="form-label">İsim Soyisim</label>
                                    <input type="text" class="form-control" name="personel_isim_soyisim"
                                           id="personel_isim_soyisim" placeholder="İsim Soyisim" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="personel_img" class="form-label">Fotoğraf</label>
                                    <input type="file" class="form-control" name="personel_img" id="personel_img">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="personel_telefon" class="form-label">Telefon</label>
                                    <input type="text" class="form-control" name="personel_telefon"
                                           id="personel_telefon" placeholder="Telefon numarası">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="personel_email" class="form-label">E-posta</label>
                                    <input type="email" class="form-control" name="personel_email" id="personel_email"
                                           placeholder="E-posta adresi">
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
                                    <label for="personel_unvan_tr" class="form-label">Unvan</label>
                                    <input type="text" class="form-control" name="translations[0][personel_unvan]"
                                           id="personel_unvan_tr" placeholder="Unvan (Türkçe)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_gorev_tr" class="form-label">Görev</label>
                                    <input type="text" class="form-control" name="translations[0][personel_gorev]"
                                           id="personel_gorev_tr" placeholder="Görev (Türkçe)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_fakulte_tr" class="form-label">Fakülte</label>
                                    <input type="text" class="form-control" name="translations[0][personel_fakulte]"
                                           id="personel_fakulte_tr" placeholder="Fakülte (Türkçe)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_bolum_tr" class="form-label">Bölüm</label>
                                    <input type="text" class="form-control" name="translations[0][personel_bolum]"
                                           id="personel_bolum_tr" placeholder="Bölüm (Türkçe)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_hakkinda_tr" class="form-label">Hakkında</label>
                                    <textarea class="form-control tinymce-editor"
                                              name="translations[0][personel_hakkinda]"
                                              id="personel_hakkinda_tr" rows="10"
                                              placeholder="Personel hakkında bilgi (Türkçe)"></textarea>
                                </div>
                            </div>

                            <!-- İngilizce İçerik -->
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <input type="hidden" name="translations[1][locale]" value="en">
                                <div class="mb-3">
                                    <label for="personel_unvan_en" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="translations[1][personel_unvan]"
                                           id="personel_unvan_en" placeholder="Title (English)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_gorev_en" class="form-label">Role</label>
                                    <input type="text" class="form-control" name="translations[1][personel_gorev]"
                                           id="personel_gorev_en" placeholder="Role (English)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_fakulte_en" class="form-label">Faculty</label>
                                    <input type="text" class="form-control" name="translations[1][personel_fakulte]"
                                           id="personel_fakulte_en" placeholder="Faculty (English)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_bolum_en" class="form-label">Department</label>
                                    <input type="text" class="form-control" name="translations[1][personel_bolum]"
                                           id="personel_bolum_en" placeholder="Department (English)">
                                </div>
                                <div class="mb-3">
                                    <label for="personel_hakkinda_en" class="form-label">About</label>
                                    <textarea class="form-control tinymce-editor"
                                              name="translations[1][personel_hakkinda]"
                                              id="personel_hakkinda_en" rows="10"
                                              placeholder="About the staff (English)"></textarea>
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
            $('#personelEkle').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('akademikEkle') }}",
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
                                    window.location.href = "{{ route('akademik-personel') }}";
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
