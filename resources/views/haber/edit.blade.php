@extends('adminlayout.master')
    @section('title', 'Haber Düzenle')
    @section('content')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Haber Düzenle</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card m-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Haber Düzenle</h6>
                        <form id="haberDuzenle" method="POST" action="{{ route('haber.update', $haber->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Sekme Menüsü -->
                            <ul class="nav nav-tabs" id="langTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tr-tab" data-bs-toggle="tab" href="#tr" role="tab"
                                       aria-controls="tr" aria-selected="true">Türkçe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab"
                                       aria-controls="en" aria-selected="false">İngilizce</a>
                                </li>
                            </ul>

                            <!-- Sekme İçerikleri -->
                            <div class="tab-content border border-top-0 p-3 mb-3" id="langTabContent">
                                <!-- Türkçe İçerik -->
                                <div class="tab-pane fade show active" id="tr" role="tabpanel" aria-labelledby="tr-tab">
                                    <input type="hidden" name="translations[0][locale]" value="tr">
                                    <div class="mb-3">
                                        <label for="haber_baslik_tr" class="form-label">Haber Başlık</label>
                                        <input type="text" class="form-control" name="translations[0][haber_baslik]"
                                               id="haber_baslik_tr" value="{{ $haber->getTranslation('tr')->haber_baslik }}"
                                               placeholder="Haber Başlık (Türkçe)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="haber_icerik_tr" class="form-label">Haber İçerik</label>
                                        <textarea class="form-control tinymce" name="translations[0][haber_icerik]"
                                                  id="haber_icerik_tr" rows="10"
                                                  placeholder="Haber İçerik (Türkçe)">{{ $haber->getTranslation('tr')->haber_icerik }}</textarea>
                                    </div>
                                </div>

                                <!-- İngilizce İçerik -->
                                <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                    <input type="hidden" name="translations[1][locale]" value="en">
                                    <div class="mb-3">
                                        <label for="haber_baslik_en" class="form-label">Haber Başlık</label>
                                        <input type="text" class="form-control" name="translations[1][haber_baslik]"
                                               id="haber_baslik_en" value="{{ $haber->getTranslation('en')->haber_baslik }}"
                                               placeholder="Haber Başlık (İngilizce)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="haber_icerik_en" class="form-label">Haber İçerik</label>
                                        <textarea class="form-control tinymce" name="translations[1][haber_icerik]"
                                                  id="haber_icerik_en" rows="10"
                                                  placeholder="Haber İçerik (İngilizce)">{{ $haber->getTranslation('en')->haber_icerik }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="yayin_tarihi" class="form-label">Yayın Tarihi</label>
                                <input type="date" class="form-control" name="yayin_tarihi" id="yayin_tarihi" value="{{ $haber->yayin_tarihi }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="haber_resim" class="form-label">Haber Resim</label>
                                <p>
                                    <img src="{{ asset('storage/' . $haber->haber_resim) }}" alt="{{ $haber->getTranslation('tr')->haber_baslik }}" class="img-thumbnail" width="200">
                                </p>
                                <input type="file" class="form-control" name="haber_resim" id="haber_resim">
                            </div>

                            <button type="submit" class="btn btn-primary">Güncelle</button>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                if (typeof tinymce !== 'undefined') {
                    tinymce.init({
                        selector: '.tinymce',
                        height: 400,
                        plugins: 'preview searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
                        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code',
                        menubar: 'file edit view insert format tools table help',
                        branding: false,
                        statusbar: false
                    });
                }

                $('#haberDuzenle').submit(function (e) {
                    e.preventDefault();
                    tinymce.triggerSave();
                    let formData = new FormData(this);
                    $.ajax({
                        url: $(this).attr('action'),
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
                                        window.location.href = "{{ route('haber.index') }}";
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
