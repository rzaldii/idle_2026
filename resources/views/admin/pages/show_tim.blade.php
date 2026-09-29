@extends('admin.layouts.base')

{{--Page Title--}}

@section('title', 'Test TItle')

{{--Custom CSS--}}

@section('css')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
@endsection

{{--App Title--}}

@section('app-title', 'Identitas Tim')
@section('app-description', '')

{{--Content--}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title">
                    {{ $tim->nama_tim }} - {{ $tim->kategori->nama_kategori }}
                    <p style="font-size: 15px; font-weight: normal">
                        <a class="btn btn-primary" href="{{ route('admin.tim.edit', ['tim' => $tim->id]) }}"><i class="fa fa-edit"></i>Edit</a>
                    <h5>Peserta :</h5>
                    </p>

                    <div class="col-md-12">
                        @foreach($tim->pesertas as $peserta)
                            <a href="{{ route('admin.peserta.show', ['peserta' => $peserta->mahasiswa->nim ]) }}" class="tile col-md-{{ 12/count($tim->pesertas) }}"
                               style="font-weight: normal; font-size: 14px; margin: 2px; display: inline-block; text-decoration: none">
                                Nama : {{ $peserta->mahasiswa->nama }} <br>
                                NIM : {{ $peserta->mahasiswa->nim }} <br>
                                Email : {{ $peserta->mahasiswa->email }} <br>
                                No HP : {{ $peserta->mahasiswa->no_hp }}
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="tile-body">
                    <h4>Submission</h4>
                    <table class="table table-hover table-bordered" id="tim-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Token</th>
                            <th>Judul</th>
                            <th>Data</th>
                            <th width="15%">Tangal</th>
                            <th width="10%">Download</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($tim->submissions as $no => $submission)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $submission->token }}</td>
                                <td>{{ $submission->judul }}</td>
                                <td>{{ $submission->data }}</td>
                                <td>{{ date('d/m/Y h:i', strtotime($submission->created_at)) }}</td>
                                <td><a href="{{ route('admin.ajax.download', ['path' => $submission->id ]) }}"
                                       class="btn btn-info">Download</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--<form action="{{ route('admin.final.destroy', ['tim' => -1, 'kategori' => $kategori->kategori ]) }}" method="post" id="delete-form">--}}
                    {{--@csrf--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

{{--Custom Javascript--}}

@section('js')
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    <script>
        function deletePost(id) {
            var c = confirm("Are you sure delete this tim?");
            if (c == true) {
                url = $('#delete-form').attr('action');
                url = url.substring(0, url.length - 2) + id;
                url = $('#delete-form').attr('action', url);
                // return;
                $('#delete-form').submit();
            } else {

            }
        }
    </script>

@endsection