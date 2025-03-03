@extends('adminlayout.master')
<!-- yield title -->
@section('title', 'Mesajlar')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mesajlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Mesajlar</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İsim Soyisim</th>
                                <th>E-posta</th>
                                <th>Konu</th>
                                <th>Görüntüle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mesajlar as $mesaj)
                                <tr>
                                    <td>{{ $mesaj->id }}</td>
                                    <td>{{ $mesaj->name }}</td>
                                    <td>{{ $mesaj->email }}</td>
                                    <td>{{ $mesaj->subject }}</td>
                                    <td>
                                        <a href="{{ route('iletisim.show', $mesaj->id) }}" class="btn btn-primary">Görüntüle</a>
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

@push('custom-scripts')
    <script>
        // Silme işlemi için
        $('.sil').click(function () {
            // Sweet Alert ile silme işlemi
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
                    // Silme işlemi
                    let id = $(this).closest('tr').find('td:first').text();
                    let tr = $(this).closest('tr');
                    $.ajax({
                        // type Delete olduğu için delete
                        type: "DELETE",
                        url: "/admin/akademik-personel-sil/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function (response) {
                            tr.remove();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText); // Hata durumunda konsola hata mesajını yazdır
                        }
                    });
                    Swal.fire(
                        'Silindi!',
                        'Silme işlemi başarıyla gerçekleşti.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
