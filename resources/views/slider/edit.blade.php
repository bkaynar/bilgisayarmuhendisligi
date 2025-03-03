@extends('adminlayout.master')
@section('title', 'Slider Düzenle')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Slider Düzenle</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Slider Düzenle</h6>
                    <form id="sliderDuzenle" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="slider_url" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" name="slider_url" id="slider_url">
                            <img src="{{ asset($slider->slider_url) }}" alt="Current Image" class="img-thumbnail mt-2"
                                 width="150">
                        </div>
                        <div class="mb-3">
                            <label for="slider_link" class="form-label">Slider Link</label>
                            <input type="url" class="form-control" name="slider_link" id="slider_link"
                                   value="{{ $slider->slider_link }}">
                        </div>

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
                                    <label for="slider_ustmetin_tr" class="form-label">Üst Metin</label>
                                    <textarea class="form-control" name="translations[0][slider_ustmetin]"
                                              id="slider_ustmetin_tr" rows="3"
                                              required>{{ $slider->getUstmetin('tr') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="slider_altmetin_tr" class="form-label">Alt Metin</label>
                                    <textarea class="form-control" name="translations[0][slider_altmetin]"
                                              id="slider_altmetin_tr" rows="3"
                                              required>{{ $slider->getAltmetin('tr') }}</textarea>
                                </div>
                            </div>

                            <!-- İngilizce İçerik -->
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <input type="hidden" name="translations[1][locale]" value="en">
                                <div class="mb-3">
                                    <label for="slider_ustmetin_en" class="form-label">Upper Text</label>
                                    <textarea class="form-control" name="translations[1][slider_ustmetin]"
                                              id="slider_ustmetin_en" rows="3"
                                              required>{{ $slider->getUstmetin('en') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="slider_altmetin_en" class="form-label">Lower Text</label>
                                    <textarea class="form-control" name="translations[1][slider_altmetin]"
                                              id="slider_altmetin_en" rows="3"
                                              required>{{ $slider->getAltmetin('en') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sliderDuzenle').addEventListener('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch('{{ route('slider.update', $slider->id) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '{{ route('slider.index') }}';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
@endsection
