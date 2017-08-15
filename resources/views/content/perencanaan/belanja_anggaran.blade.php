@extends('layouts.template')

@section('title', 'Rancangan Belanja APBD')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title') Tahun {{ $current_year }}
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection


@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group form-group-sm">
                    <label for="jenis_kegiatan" class="col-sm-2">Jenis Kegiatan </label>
                    <div class="col-md-8">
                        <select name="jenis_kegiatan" id="jenis_kegiatan" class="col-sm-5 form-control selectpicker">
                            <option value="">Pilih Kegiatan</option>
                            @foreach($table as $index => $value)
                                {{--<option value="surat-keterangan-kehilangan">{{ var_dump($index) }}</option>--}}
                                <optgroup label="{{ $index }}">
                                    @foreach($value as $v)
                                        <option value="{{ $v['index'] }}">{{ $v['value'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-default" id="btn-lihat"><i class="fa fa-search-plus"></i> Lihat</button>
                    <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body" id="load-data">

        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    $(function(){
        $('button#btn-lihat').click(function(){
            var id = $('select[name=jenis_kegiatan]').val();
            $.ajax({
                url   : "{{ route('anggaran-table', '') }}/"+id
            }).done(function(data){
                $('#load-data').html(data);
            });
        });
    });
</script>
@endpush