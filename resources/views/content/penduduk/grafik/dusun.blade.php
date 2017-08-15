@extends('layouts.template')

@section('title', 'Grafik Penduduk Berdasarkan RW')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection


@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            {{--<div class="btn-group">--}}
                {{--<button class="btn btn-default btn-sm" onclick="return exports()" data-toggle="tooltip" data-original-title="Export" data-placement="top"><i class="fa fa-download"></i> Export</button>--}}
            {{--</div>--}}

            <div id="chart-penduduk-dusun"></div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle" rowspan="2">No</th>
                    <th style="text-align: center; vertical-align: middle" rowspan="2">Kategori</th>
                    <th style="text-align: center; vertical-align: middle" colspan="2">Jenis Kelamin</th>
                    <th style="text-align: center; vertical-align: middle" rowspan="2">Total</th>
                </tr>
                <tr>
                    <th style="text-align: center; vertical-align: middle">Laki-Laki</th>
                    <th style="text-align: center; vertical-align: middle">Perempuan</th>
                </tr>
                </thead>
                <tbody>

                @php ($pd=1)
                @php($laki=0)
                @php($pr =0)
                @php($total =0)
                @foreach($dusun['table'] as $p)
                    <tr>
                        <td style="text-align: center; vertical-align: middle">{{$pd++}}</td>
                        <td style="text-align: center; vertical-align: middle">{{ $p->label }}</td>
                        <td style="text-align: center; vertical-align: middle">{{ $p->jumlah_laki }}</td>
                        <td style="text-align: center; vertical-align: middle">{{ $p->jumlah_perempuan }}</td>
                        <td style="text-align: center; vertical-align: middle">{{ $p->total }}</td>
                        @php($laki += $p->jumlah_laki)
                        @php($pr += $p->jumlah_perempuan)
                        @php($total += $p->total)
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: right; vertical-align: middle">Jumlah</td>
                    <td style="text-align: center; vertical-align: middle">{{ $laki }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ $pr }}</td>
                    <td style="text-align: center; vertical-align: middle">{{ $total }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')
{{ Html::script('assets/plugins/fusioncharts/js/fusioncharts.js') }}
{{ Html::script('assets/plugins/fusioncharts/js/themes/fusioncharts.theme.fint.js') }}
<script type="text/javascript">
    FusionCharts.ready(function () {

        var dusun = new FusionCharts({
            "type": "pie3d",
            "renderAt": "chart-penduduk-dusun",
            "width": "100%",
            "height": "300",
            "dataFormat": "json",
            "dataSource": {!! json_encode($dusun['grafik']) !!}

        });
        dusun.render();
    });
</script>
@endpush