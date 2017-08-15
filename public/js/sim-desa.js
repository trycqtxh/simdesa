/**
 * Created by Hamid on 19/03/2017.
 */
var NOTIF = (function(){
    function notif(){}

    notif.show = function(params){
        var img;
        if(typeof params.type !== "undefined"){
            switch (params.type){
                case "error":
                    img = "../../img/notif/error.png";
                    break;
                case "Berhasil" :
                    img = "../../img/notif/success.png";
                    break;
                case "warning" :
                    img = "../../img/notif/warning.png";
                    break;
            }
        }
        $.gritter.add({
            title      : params.title || params.type || "Notifikasi",
            text       : params.message || "Pesan",
            image      : img || "../../img/notif/error.png",
            sticky     : params.sticky || false,
            time       : params.delay || '5000',
            class_name : params.class || 'my-sticky-class'
        });
    }

    return notif;
})($);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

$(document).ajaxStart(onStart)
    .ajaxStop(onStop)
    .ajaxSend(onSend)
    .ajaxComplete(onComplete)
    .ajaxSuccess(onSuccess)
    .ajaxError(onError);

function onStart(event, settings){
    //console.log("Start Global =========================================");
    //console.log('------ # Event   # ------');
    //console.log(event);
    //console.log('------ # Setting # ------');
    //console.log(settings);
}

function onStop(event){
    //console.log("Stop Global =========================================");
    //console.log('------ # Event   # ------');
    //console.log(event);

}

function onSend(event, xhr, settings){
    //console.log("Send Global =========================================");
    //console.log('------ # Event   # ------');
    //console.log(event);
    //console.log('------ # jqXHR   # ------');
    //console.log(xhr);
    //console.log('------ # Setting # ------');
    //console.log(settings);
    if(typeof settings.context !== 'undefined'){
        switch (settings.context.context) {
            case "form" :
                $('.loading').show();
                break;
            case "table" :
                $('.loading').show();
        }
    }
}

function onComplete(event, xhr, settings){
    //console.log("Complete Global =====================================");
    //console.log('------ # Event   # ------');
    //console.log(event);
    //console.log('------ # jqXHR   # ------');
    //console.log(xhr);
    //console.log('------ # Setting # ------');
    //console.log(settings);
    if(typeof settings.context !== "undefined"){
        switch (settings.context.context) {
            case "form" :
                $('.loading').hide();
                break;
            case "table" :
                $('.loading').hide();
                break;
        }
    }
}

function onSuccess(event, xhr, settings){
    //console.log("Success Global ======================================");
    //console.log('------ # Event   # ------');
    //console.log(event);
    //console.log('------ # jqXHR   # ------');
    //console.log(xhr);
    //console.log('------ # Setting # ------');
    //console.log(settings);
    if(typeof settings.context !== "undefined"){
        switch (settings.context.context){
            case "form" :
                $('.loading').hide();
                $(".modal").modal("hide");

                NOTIF.show({
                    type    : "Berhasil",
                    title   : xhr.responseJSON.title,
                    message : xhr.responseJSON.message
                });
                break;
            case "table" :
                $('.loading').hide();
                break;
        }
    }
}

function onError(event, xhr, settings, thrownError){
    //console.log("Error Global =========================================");
    //console.log('------ # Event   # ------');
    //console.log(event);
    //console.log('------ # jqXHR   # ------');
    //console.log(xhr);
    //console.log('------ # Setting # ------');
    //console.log(settings);
    //console.log('------ # thrownError #---');
    //console.log(thrownError);
    if(typeof settings.context !== "undefined"){

        switch (settings.context.context){
            case "form":
                switch(xhr.status){

                    //Validation
                    case 422:
                        if(xhr.responseJSON.message){

                            $.each(xhr.responseJSON.message, function(key, val){
                                NOTIF.show({
                                    title   : xhr.responseJSON.title,
                                    message : val
                                });
                            });
                        }else{
                            $.each(xhr.responseJSON, function(key, val){
                                NOTIF.show({
                                    title   : xhr.responseJSON.title,
                                    message : val
                                });
                            });
                        }
                        //console.log(xhr.responseJSON)
                        break;
                    //Laravel
                    case 400:
                        NOTIF.show({
                            title   : xhr.responseJSON.errors,
                            message : xhr.responseJSON.message,
                        });
                        break;
                    case 401:
                        NOTIF.show({
                            title   : xhr.responseJSON.title,
                            message : xhr.responseJSON.message,
                        });
                        break;
                    case 402:
                        NOTIF.show({
                            title   : xhr.responseJSON.title,
                            message : xhr.responseJSON.message,
                        });
                        break;
                    case 500:
                        NOTIF.show({
                            title   : xhr.responseJSON.title,
                            message : xhr.responseJSON.message,
                        });
                        break;
                }
                break;
            case "table":
                NOTIF.show({
                    title   : xhr.responseJSON.errors,
                    message : xhr.responseJSON.message,
                });
                break;
        }
    }
}
