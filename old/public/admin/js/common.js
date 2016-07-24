/**
 * Created by pembr on 20.03.2016.
 */
$(document).ready(function(){
    $('#datepicker').datepicker({
        autoclose: true
    });
    //Date range picker
    $('#dateRange').daterangepicker();
    triggered = false;
    $('select.guests').on('change', function(){
        if($(this).val() != -1)
            $(this).prop('disabled', 'disabled');
        if(!triggered || $(this).val() == -1) {
            $('.sidebar-toggle').trigger('click');
            triggered = true;
            if($(this).val() == -1)
                triggered = false;
        }
        if($(this).val() == -1){
            $('form.rates-table').hide();
        }
        else {
            $('.preloader').removeClass('hidden');
            $('form.rates-table').hide();
            guests = $('select.guests').val();
            tt = $('.tt').val();
            $.ajax({
                type: "POST",
                url: location.href,
                data: {getData: 1, tid: $('.tid').val(), guests: guests, tt: tt},
                success: function(e){
                    rates = $.parseJSON(e);
                    //console.log(rates);
                    if(rates.length != 0) {
                        for (var key in rates) {
                            $('input[name=' + key + ']').val(rates[key]);
                        }
                    }
                    else
                    $('input.cost').val('');
                }
            });
            setTimeout(function() {
                $('form.rates-table').show();
                $('.preloader').addClass('hidden');
                $('select.guests').removeAttr('disabled');
            }, 2000);
        }
    });

    $('form.rates-table').on('submit', function(){
        $('.preloader').removeClass('hidden');
        $('form.rates-table').hide();
        setTimeout(function() {
            $('form.rates-table').show();
            $('.preloader').addClass('hidden');
            var json_data = $('form.rates-table').serializeArray();
            tid = $('.tid').val();
            guests = $('select.guests').val();
            act = $('#isActive').is(':checked');
            tt = $('.tt').val();
            start_ts = $('#datepicker').val();
            title = $('#title').val();
            $.ajax({
                type: "POST",
                url: location.href,
                data: {tid: tid, tt: tt, start_ts: start_ts, title: title, isActive: act, guests: guests, json_data: json_data},
                success: function(e){
                    e = $.parseJSON(e);
                    $('.tt').val(e.tt);
                    $('form.rates-table').show();
                    $('.preloader').addClass('hidden');
                }
            });
        }, 2000);
       return false;
    });

    $('.del-img').on('click', function(){
        var name = $(this).attr('id');
        $.post(location.href, {delete: 1, file: name});
        $(this).closest('.jFiler-item').hide();
    });

    $("#filer_input2").filer({
        limit: null,
        maxSize: null,
        extensions: null,
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Перетащите файлы сюда</h3> <span style="display:inline-block; margin: 15px 0">или</span></div><a class="jFiler-input-choose-btn blue">Выберите файлы</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
        },
        uploadFile: {
            //url: "./upload.php",
            url: location.href,
            data: {upload: 1},
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){},
            success: function(data, el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Загружено</div>").hide().appendTo(parent).fadeIn("slow");
                });
            },
            error: function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Ошибка</div>").hide().appendTo(parent).fadeIn("slow");
                });
            },
            statusCode: null,
            onProgress: null,
            onComplete: null
        },
        files: null,
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post(location.href, {delete: 1, file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Выберите файлы",
            feedback: "Выберите файлы для загрузки",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Вы уверены что хотите удалить этот файл?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });

});