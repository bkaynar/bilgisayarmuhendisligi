@extends('adminlayout.master')
@section('title', 'Etkinlik Ekle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Etkinlik Ekle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Etkinlik Ekle</h6>
                   <form id="etkinlikEkle" method="POST" action="{{ route('etkinlik.store') }}" enctype="multipart/form-data">
                   @csrf
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
                               <label for="etkinlik_baslik_tr" class="form-label">Etkinlik Başlık</label>
                               <input type="text" class="form-control" name="translations[0][etkinlik_baslik]"
                                      id="etkinlik_baslik_tr" placeholder="Etkinlik Başlık (Türkçe)" required>
                           </div>
                           <div class="mb-3">
                               <label for="etkinlik_icerik_tr" class="form-label">Etkinlik İçerik</label>
                               <input type="text" class="form-control" name="translations[0][etkinlik_icerik]"
                                      id="etkinlik_icerik_tr" placeholder="Etkinlik İçerik (Türkçe)" required>
                           </div>
                           <div class="mb-3">
                               <label for="etkinlik_text_tr" class="form-label">Etkinlik Metni</label>
                               <textarea class="form-control" name="translations[0][etkinlik_text]"
                                         id="etkinlik_text_tr" rows="10"
                                         placeholder="Etkinlik Metni (Türkçe)"></textarea>
                           </div>
                       </div>

                       <!-- İngilizce İçerik -->
                       <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                           <input type="hidden" name="translations[1][locale]" value="en">
                           <div class="mb-3">
                               <label for="etkinlik_baslik_en" class="form-label">Etkinlik Başlık</label>
                               <input type="text" class="form-control" name="translations[1][etkinlik_baslik]"
                                      id="etkinlik_baslik_en" placeholder="Etkinlik Başlık (İngilizce)" required>
                           </div>
                           <div class="mb-3">
                               <label for="etkinlik_icerik_en" class="form-label">Etkinlik İçerik</label>
                               <input type="text" class="form-control" name="translations[1][etkinlik_icerik]"
                                      id="etkinlik_icerik_en" placeholder="Etkinlik İçerik (İngilizce)" required>
                           </div>
                           <div class="mb-3">
                               <label for="etkinlik_text_en" class="form-label">Etkinlik Metni</label>
                               <textarea class="form-control" name="translations[1][etkinlik_text]"
                                         id="etkinlik_text_en" rows="10"
                                         placeholder="Etkinlik Metni (İngilizce)"></textarea>
                           </div>
                       </div>
                   </div>

                   <div class="mb-3">
                       <label for="etkinlik_tarih" class="form-label">Etkinlik Tarih</label>
                       <input type="date" class="form-control" name="etkinlik_tarih" id="etkinlik_tarih" required>
                   </div>
                   <div class="mb-3">
                       <label for="etkinlik_resim" class="form-label">Etkinlik Resim</label>
                       <input type="file" class="form-control" name="etkinlik_resim" id="etkinlik_resim" required>
                   </div>

                   <button type="submit" class="btn btn-primary">Kaydet</button>
               </form> </div>
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
            $('#etkinlikEkle').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('etkinlik.store') }}",
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
                                    window.location.href = "{{ route('etkinlik.index') }}";
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
