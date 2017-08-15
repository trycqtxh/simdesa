<style>
    fieldset {
        /*margin-top: 1em;*/
        border-radius: 4px 4px 0 0;
        -moz-border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
        border: #aaa solid 1px;
        padding: 1.5em;
        margin-bottom: 15px;
    }
    fieldset legend {
        font-weight: bold;
        color: #444;
        padding: 5px 10px;
        border-radius: 2px;
        border: 1px solid #aaa;
        font-family: "Courier New", Courier, monospace;
        font-size: 12px;
        margin-bottom: 5px;
    }
    fieldset label {
        width: 100%;
        font-family: "Courier New", Courier, monospace;
        font-size: 12px;

    }
    .fieldset-anak-4{
        width: 29%;
        margin: 0px 16px;
        margin-bottom: 16px;
        float: left;
    }
    .fieldset-anak-3{
        width: 21%;
        margin: 0px 20px;
        margin-bottom: 16px;
        float: left;
    }
    /*Hide all except first div*/
    #msform div#tab:not(:first-of-type) {
        display: none;
    }
    /*buttons*/
    #msform .action-button {
        width: 100px;
        background: #27AE60;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 5px 5px;
        margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
</style>
<div class="modal-body" id="msform">
    <!-- divs -->
    <div id="tab">
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Aturan</span></legend>
            <div class="form-group form-group-sm">
                <label for="name" class="col-md-3 control-label">Nama</label>
                <div class="col-md-9">
                    <input class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label for="display_name" class="col-md-3 control-label">Nama Tampilan</label>
                <div class="col-md-9">
                    <input class="form-control" name="display_name" id="display_name">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label for="description" class="col-md-3 control-label">Deskripsi</label>
                <div class="col-md-9">
                    <input class="form-control" name="description" id="description">
                </div>
            </div>
            <div class="clearfix"></div>
        </fieldset>
    </div>
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Master Data</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'master')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4" id="{{ $m->display_name }}">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('master_', '', $m->display_name) }}</span> <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name.'-'.$sm->display_name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}" > {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Penduduk</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'penduduk')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('penduduk_', '', $m->display_name) }}</span>  <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}"> {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Perencanaan</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'perencanaan')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('perencanaan_', '', $m->display_name) }}</span>  <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}"> {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Pelaksanaan</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'pelaksanaan')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('pelaksanaan_', '', $m->display_name) }}</span>  <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}"> {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />

        @if(Auth()->user()->admin)
        <input type="button" name="next" class="next action-button pull-right" value="Lanjut" />
        @endif

        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Umum</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'umum')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('umum_', '', $m->display_name) }}</span>  <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}"> {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>

    @if(Auth()->user()->admin)
    <div id="tab">
        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
        <div class="clearfix"></div>
        <fieldset>
            <legend><span>Pembangunan</span></legend>
            @php($master = DB::table('permissions')->select('display_name')->where('description', 'pembangunan')->groupBy('display_name')->get() )
            @foreach($master as $m)
                <fieldset class="fieldset-anak-4">
                    @php($sub_master = DB::table('permissions')->where('display_name', $m->display_name)->get() )
                    @php( $sm = $sub_master->first())
                    <legend><span>{{ str_replace('pembangunan_', '', $m->display_name) }}</span>  <input type="checkbox" id="all_{{ $sm->display_name }}" name="{{ $sm->display_name }}"> check all</legend>
                    @foreach($sub_master as $sm)
                        <label for="_{{ $sm->name }}">
                            <input type="checkbox" id="_{{ $sm->name.'-'.$sm->display_name }}" name="permission[]" value="{{ $sm->id }}"> {{ $sm->tampilan }}
                        </label>
                    @endforeach
                </fieldset>
            @endforeach
        </fieldset>
    </div>
    @endif
</div>
<div class="modal-footer">
    <button class="btn btn-default" tabindex="7">Simpan</button>
</div>
<script>

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function(){
        if(animating) return false;
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        $("#progressbar li").eq($("div#tab").index(next_fs)).addClass("active");
        next_fs.show();
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            complete: function(){
                current_fs.hide();
                animating = false;
            },
        });
    });

    $(".previous").click(function(){
        if(animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li").eq($("div#tab").index(current_fs)).removeClass("active");
        previous_fs.show();
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            complete: function(){
                current_fs.hide();
                animating = false;
            },
        });
    });

    $(function(){
        $("input[id^='all_']").on('change', function () {
            var name = $(this).get(0).name;
            console.log(name);
            console.log($(this).is(':checked'));
            if($(this).is(':checked') == true){
                $("input[id*="+name+"]").prop('checked', true);
            }
            else{
                $("input[id*="+name+"]").prop('checked', false);
            }
        });

    });
</script>