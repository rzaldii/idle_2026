@extends('admin.layouts.base')

{{--Page Title--}}

@section('title', 'Nilai')

{{--Custom CSS--}}

@section('css')

@endsection

{{--App Title--}}

@section('app-title', 'Nilai Tahap 1')
@section('app-description', '')

{{--Content--}}

@section('content')
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Set Nilai {{ $tahap }}</h3>
                </div>

                <div class="tile-body">
                    <form action="" method="post" id="nilai-form">
                        @csrf

                        <div class="form-group">
                            <label for="">Nama Tim</label>
                            <select class="form-control" id="tim-select" name="tim">
                                <optgroup label="Nama Tim">
                                    <option value="-1">Pilih Tim</option>
                                    @foreach($tims as $tim)
                                        <option value="{{ $tim->id }}">{{ $tim->nama_tim }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Nilai</label>
                            <input class="form-control" type="text" name="nilai" placeholder="Masukan Nilai" id="nilai">
                        </div>
                        <input type="hidden" name="babak" value="{{ $babak }}" id="babak-value">
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="button" name="submit" id="submit-btn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}

@section('js')
    <script>
        $('#tim-select').change(function () {
            if (this.value == -1 || this.value == '') {
                $('#nilai').val('');
                return;
            }
            $.ajax({
                type: 'GET',
                url: '/admin/ajax/nilai/' + this.value + '/' + $('#babak-value').val(),
                success: function (data) {
                    $('#nilai').val(data);
                },
                error: function(){
                    $('#nilai').val('');
                }
            });
        });

        $('#submit-btn').click(function () {
            var selectedTim = $('#tim-select').val();
            var inputNilai = $('#nilai').val();

            if (selectedTim == -1 || selectedTim == '') {
                errorNotification('Error', 'Silakan pilih tim terlebih dahulu');
                return;
            }

            if (inputNilai === '' || isNaN(inputNilai)) {
                errorNotification('Error', 'Silakan masukkan nilai yang valid');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/admin/ajax/nilai',
                data: $('#nilai-form').serialize(),
                success: function(data){
                    if(data == true || data == 1){
                        successNotification('Success', 'Data berhasil ditambahkan');
                    } else {
                        errorNotification('Failed', 'Gagal menyimpan nilai');
                    }

                    $('#tim-select').val(-1);
                    $('#nilai').val('');
                },
                error: function(xhr, status, error){
                    var message = 'Something Error';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    errorNotification('Error', message);
                }
            });
        });
    </script>
@endsection