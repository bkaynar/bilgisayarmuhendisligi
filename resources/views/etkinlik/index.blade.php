@extends('adminlayout.master')
@section('title', 'Etkinlikler')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Etkinlikler</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Etkinlikler</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Türkçe Başlık</th>
                                <th>İngilizce Başlık</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($etkinlikler as $etkinlik)
                                <tr>
                                    <td>{{ $etkinlik->id }}</td>
                                    <td>{{ $etkinlik->getTranslation('tr')->etkinlik_baslik }}</td>
                                    <td>{{ $etkinlik->getTranslation('en')->etkinlik_baslik }}</td>
                                    <td>
                                        <a href="{{ route('etkinlik.edit', $etkinlik->id) }}" class="btn btn-primary">Düzenle</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger sil">Sil</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
        $('.sil').click(function () {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlemi geri alamayacaksınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).closest('tr').find('td:first').text();
                    let tr = $(this).closest('tr');
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/etkinlik/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function (response) {
                            tr.remove();
                            Swal.fire(
                                'Silindi!',
                                'Etkinlik başarıyla silindi.',
                                'success'
                            );
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endpush
