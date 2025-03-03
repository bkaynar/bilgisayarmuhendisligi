@extends('adminlayout.master')
@section('title', 'Hedef Düzenle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hedef Düzenle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Hedef Düzenle</h6>
                    <form id="hedefDuzenle" method="POST" action="{{ route('hedefler.update', $hedef->id) }}">
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
                                    <label for="hedef_baslik_tr" class="form-label">Hedef Başlık</label>
                                    <input type="text" class="form-control" name="translations[0][hedef_baslik]"
                                           id="hedef_baslik_tr" value="{{ $hedef->getTranslation('tr')->hedef_baslik }}"
                                           placeholder="Hedef Başlık (Türkçe)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hedef_icerik_tr" class="form-label">Hedef İçerik</label>
                                    <textarea class="form-control" name="translations[0][hedef_icerik]"
                                              id="hedef_icerik_tr" rows="10"
                                              placeholder="Hedef İçerik (Türkçe)">{{ $hedef->getTranslation('tr')->hedef_icerik }}</textarea>
                                </div>
                            </div>

                            <!-- İngilizce İçerik -->
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <input type="hidden" name="translations[1][locale]" value="en">
                                <div class="mb-3">
                                    <label for="hedef_baslik_en" class="form-label">Hedef Başlık</label>
                                    <input type="text" class="form-control" name="translations[1][hedef_baslik]"
                                           id="hedef_baslik_en" value="{{ $hedef->getTranslation('en')->hedef_baslik }}"
                                           placeholder="Hedef Başlık (İngilizce)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hedef_icerik_en" class="form-label">Hedef İçerik</label>
                                    <textarea class="form-control" name="translations[1][hedef_icerik]"
                                              id="hedef_icerik_en" rows="10"
                                              placeholder="Hedef İçerik (İngilizce)">{{ $hedef->getTranslation('en')->hedef_icerik }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function () {
            $('#hedefDuzenle').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('hedefler.update', $hedef->id) }}",
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
                                    window.location.href = "{{ route('hedefler.index') }}";
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
