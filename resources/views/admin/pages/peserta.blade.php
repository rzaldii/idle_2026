@extends('admin.layouts.base')

{{--Page Title--}}
@section('title', 'Peserta')

{{--Custom CSS--}}
@section('css')
@endsection

{{--App Title--}}
@section('app-title', 'Daftar Peserta')
@section('app-description', 'Daftar peserta lomba IDLe sesuai bidang yang dinaungi')

{{--Content--}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group">
                    <a href="{{ route('admin.export.pesertas') }}"
                       class="btn btn-success"><span class="fa fa-file-excel-o"></span> Cetak XLS</a>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="peserta-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="14%">NIM</th>
                            <th>Nama</th>
                            <th>Nama Tim</th>
                            <th>Email</th>
                            <th width="14%">No HP</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}
@section('js')
    <script>
        $(document).ready(function () {
            $('#peserta-table').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.ajax.peserta') }}",
                columns: [
                    {data: 'no'},
                    {
                        data: 'nim',
                        render: function (data, type, row) {
                            return "<a href='/admin/peserta/" + data + "'>" + data + "</a>";
                        }
                    },
                    {data: 'nama'},
                    {
                        data: 'nama_tim',
                        render: function (data, type, row) {
                            if (row.id_tim) {
                                return "<a href='/admin/tim/" + row.id_tim + "'>" + data + "</a>";
                            }
                            return data;
                        }
                    },
                    {data: 'email'},
                    {data: 'no_hp'},
                    {
                        data: 'nim',
                        render: function (data, type, row) {
                            return "<a href='/admin/peserta/" + data + "/edit' class='btn btn-info btn-sm'>Edit</a>";
                        }
                    }
                ]
            });
        });
    </script>
@endsection
