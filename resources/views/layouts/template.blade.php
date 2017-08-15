<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @php( $profil = new \App\Entities\ProfilDesa() )
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shortcut icon" type="image/png" href="{{ url('img/logo/'.$profil->find('logo_desa')['value']) }}"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.6 -->
    {{ Html::style('assets/bootstrap/css/bootstrap.css') }}
            <!-- Font Awesome -->
{{--    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}--}}
    {{ Html::style('assets/bower_components/components-font-awesome/css/font-awesome.min.css') }}
            <!-- Ionicons -->
{{--    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}--}}
    {{ Html::style('assets/bower_components/Ionicons/css/ionicons.min.css') }}
            <!-- Theme style -->
    {{ Html::style('assets/dist/css/AdminLTE.min.css') }}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {{ Html::style('assets/dist/css/skins/_all-skins.css') }}
            <!-- iCheck -->
    {{ Html::style('assets/plugins/iCheck/flat/blue.css') }}
            <!-- Date Picker -->
    {{ Html::style('assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
            <!-- bootstrap wysihtml5 - text editor -->
    {{ Html::style('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
            <!-- Data Tables -->
    {{ Html::style('assets/bower_components/datatables.net-dt/css/jquery.dataTables.css') }}
    {{ Html::style('assets/bower_components/datatables.net-select-dt/css/select.dataTables.min.css') }}
    {{ Html::style('assets/bower_components/datatables.net-fixedcolumns-dt/css/fixedColumns.dataTables.min.css') }}
    {{ Html::style('assets/bower_components/datatables.net-fixedheader-dt/css/fixedHeader.dataTables.min.css') }}
    {{ Html::style('assets/bower_components/datatables.net-scroller-dt/css/scroller.dataTables.min.css') }}

    {{ Html::style('assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}

    {{ Html::style('assets/plugins/gritter/css/jquery.gritter.css') }}

    {{ Html::style('css/sim-desa.css') }}
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{ Html::style('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}
    {{ Html::style('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->


    @stack('css')
</head>
<body class="skin-green-light sidebar-mini wysihtml5-supported ">
<div id="top-header">
    <div id="top-logo" >
        <img src= "{{ url('img/logo/'.Profil::find('logo_desa')['value']) }}" class="top-img" >
        <div id="top-kata">
            <h1 style="color: #ffffff; font-family: Stencil">{{ strtoupper(config('app.name')) }}</h1>
            <h5 style="color: #ffffff">
                {{ Profil::find('des')['value'].' '.Profil::find('nama_desa')['value'] }} -
                {{ Profil::find('kec')['value'].' '.Profil::find('kecamatan')['value'] }} -
                {{ Profil::find('kab')['value'].' '.Profil::find('kota')['value'] }} -
                {{ Profil::find('prov')['value'].' '.Profil::find('provinsi')['value'] }}
            </h5>
        </div>
    </div>
</div>
<div class="wrapper">

    @include('fixed.header')
    @include('fixed.leftside')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content-header')

                <!-- Main content -->
        <section class="content">
            @yield('content-main')
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> {{ config('app.version') }}
        </div>
        <strong>Copyright &copy; 2017 {{ config('app.name') }}.</strong> All rights
        reserved.
    </footer>

    @include('fixed.controlsidebar')
</div>
<!-- ./wrapper -->
<div class="loading">
    <img src="{{ url('img/logo/logo-desa.gif') }}">
</div>
<!-- jQuery 2.2.3 -->
{{ Html::script('assets/plugins/jQuery/jquery-2.2.3.min.js') }}
        <!-- jQuery UI 1.11.4 -->
{{--{{ Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') }}--}}
{{ Html::script('assets/bower_components/jquery-ui/jquery-ui.min.js') }}
<!-- Bootstrap 3.3.6 -->
{{ Html::script('assets/bootstrap/js/bootstrap.min.js') }}
        <!-- Bootstrap WYSIHTML5 -->
{{ Html::script('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
        <!-- Slimscroll -->
{{ Html::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

{{--{{ Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}--}}
{{ Html::script('assets/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
        <!-- FastClick -->
{{ Html::script('assets/plugins/fastclick/fastclick.js') }}
        <!-- AdminLTE App -->
{{ Html::script('assets/dist/js/app.min.js') }}
        <!-- AdminLTE for demo purposes -->
{{ Html::script('assets/bower_components/datatables.net/js/jquery.dataTables.js') }}
{{ Html::script('assets/bower_components/datatables.net-select/js/dataTables.select.min.js') }}
{{ Html::script('assets/bower_components/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js') }}
{{ Html::script('assets/bower_components/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}
{{ Html::script('assets/bower_components/datatables.net-scroller/js/dataTables.scroller.min.js') }}

{{ Html::script('assets/bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}
{{ Html::script('assets/bower_components/jquery.inputmask/dist/inputmask/inputmask.date.extensions.js') }}
{{ Html::script('assets/bower_components/jquery.inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}

{{ Html::script('assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}
        <!-- Notifikasi-->
{{ Html::script('assets/plugins/gritter/js/jquery.gritter.js') }}
{{-- accounting jS--}}
{{ Html::script('assets/plugins/accounting/accounting.min.js') }}
{{ Html::script('assets/plugins/animateNumber/jquery.animateNumber.min.js') }}

{{ Html::script('assets/bower_components/moment/moment.js') }}

{{ Html::script('js/sim-desa.js') }}

<script type="application/javascript">
    @php( $p = App\Entities\ProfilDesa::all() )
    Inputmask.extendAliases({
        rupiah: {
            groupSeparator: ".",
            radixPoint: ",",
            alias: "currency",
            placeholder: "000",
            autoGroup: true,
            digits: 0,
            prefix: "",
            rightAlign: true,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1,
            allowMinus: false,
            allowPlus: false,
        },
        nik: {
            //removeMaskOnSubmit: true,
            //alias: "numeric",
            'autounmask': true,
            mask: "{{ $p->find('kode_provinsi')['value'].$p->find('kode_kota')['value'].$p->find('kode_kecamatan')['value'] }}9999999999",
            prefix: "0000",
            rightAlign: false
        }
    });
    
    $(function(){
        $('a[href="{{ Request::fullUrl() }}"]').addClass('active');
        $('a[href|="{{ Request::fullUrl() }}"]').addClass('active');
        $('a[href|="{{ Request::fullUrl() }}"]').parents('li').addClass('active');
    });
</script>

@stack('js')

</body>
</html>