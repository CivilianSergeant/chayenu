@extends('layouts.master')

@section('page-title')
: {{$parsha->parsha_name.' '.$parsha->id}}
@stop

@section('top-menu')
<ul class="nav navbar-nav">

    <li class="active"><a href="{{url('parsha/'.$parsha->id)}}"><span class="glyphicon glyphicon-pencil"></span> Add/Edit Text</a></li>

    <li><a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-remove"></span> Change Parsha</a></li>

</ul>
@stop

@section('main-content')
<style>
    .strike_through{text-decoration:line-through;}
</style>
@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
    <div class="col-md-12 jumbotron">
        <form id="textSubmit" class="form-horizontal" action="{{url('text/save')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="parsha_id" value="{{$parsha->id}}"/>
        <h3>Add/Edit text for {{$parsha->parsha_name}} {{$parsha->id}}</h3>
        <div class="form-group">
            <label class="control-label col-md-1"><strong>Section</strong>:</label>
            <div class="col-md-3">
                <select name="section" style="padding:10px;" id="selectSection" required="required">
                    <option>Please Select</option>
                    @if(!empty($sections))
                        @foreach($sections as $section)
                            <option value="{{$section->id}}" @if(strtolower($section->title)=="tanya") selected="selected" @endif>{{$section->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1"><strong>Days</strong>:</label>
            <div class="col-md-3">
                <select name="day_num" style="padding: 10px;" id="selectDay" required="required">
                    <option>Please Select</option>
                </select>
            </div>
        </div>
            <div id="loader" class="hidden">
                <h3 class="text-info">Loading ...</h3>
            </div>
            <div id="subSections" class="hidden">
            <p><input type="checkbox" id="sync_all"> <label for="sync_all">Sync all rows in this section/day</label></p>
            <div id="englishOnly">


            </div>


            <hr>

            <div id="hebEng">

            </div>

            
            <hr>

            <!--<h3>English only section (<input type="checkbox" name="sync" id="sync3" checked> <label for="sync3" style="color:green">Sync</label>) <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button></h3>

            <div class="tanya_textarea" style="height:250px;">
                <span style="font-size:15px;">Not merely from a rooftop but from a “lofty rooftop”; not merely into a pit, but into a “deep pit.”</span>
            </div>

            <br><br>-->
            <div id="newSubSection">

            </div>
            <div id="hebNewSubSection">

            </div>

            <button id="addHebBtn" class="btn btn-default btn-lg" type="button"><span class="glyphicon glyphicon-plus"></span> Add Hebrew/English Section</button>


            <button id="addEngOnlyBtn" class="btn btn-default btn-lg" type="button"><span class="glyphicon glyphicon-plus"></span> Add English only summary section</button>


            <br><br>


            <button class="btn btn-primary btn-lg center-block" type="submit"><span class="glyphicon glyphicon-ok"></span> Save & Preview Tanya</button>
            </div>
        </form>
    </div>
@stop

@section('scripts')
<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
<script>



    tinymce.init({
        mode:"none",
        menubar: false,

        plugins: "code",

        toolbar: 'formatselect, fontselect, fontsizeselect, styleselect | cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, superscript | bold, italic, underline strikethrough, alignleft, aligncenter, alignright, alignjustify, code',

        selector:'#hebText'

    });

    tinymce.init({
        mode:"none",
        menubar: false,

        plugins: "code",

        toolbar: 'formatselect, fontselect, fontsizeselect, styleselect | cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, superscript | bold, italic, underline strikethrough, alignleft, aligncenter, alignright, alignjustify, code',

        selector:'#engText'

    });




</script>
<script type="text/javascript">
    var days = null;
    var deleteItemArr = [];
    var sync = [];
    var newItemCount = 1;
    var getDays = function(id){
        var token = "{{csrf_token()}}";
        $.ajax({
            type:"POST",
            url:"{{url('ajax-get-days')}}",
            data: {section_id:id,_token:token},

            success:function(e){
                var data = JSON.parse(e);
                var days = data.days;

                var optionHtml ='<option value="">Please Select</option>';
                for(d in days){
                    optionHtml += '<option value="'+d+'">'+days[d]+'</option>';

                }

                $("#selectDay").html(optionHtml);

            }
        });

    };

    var sectionId = $("#selectSection").val();
    if(sectionId != undefined || sectionId != null)
    {
        getDays(sectionId);
    }

    $("#selectSection").change(function(){
        var obj = $(this);
        getDays(obj.val());
    });


    $("#selectDay").change(function(){
        var obj = $(this);
        var token = "{{csrf_token()}}";


        $.ajax({
           url:"{{url('ajax-get-texts')}}",
           type:"POST",
           data:{_token:token,day_num:obj.val(),section_id:$("#selectSection").val()},
           beforeSend:function(){
               $("#englishOnlySection").html('');
               $("#hebText").html('');
               $("#engText").html('');
               $("#subSections").addClass('hidden');
               $("#loader").removeClass('hidden');
           },
           success:function(e){


               var data= JSON.parse(e);
               var text_both = data.text_both;
               var text_eng_heb  = data.text_eng_heb;
               

               var htmlTxtBothContent = '';
               var htmlTxtEng = '';
               var htmlTxtHeb = '';


               var englishOnlyHeader = '';
               for(tb in text_both){

                   var t = text_both[tb].text_both.trim();
                   if(t != ""){
                       englishOnlyHeader = '<h3><span>English Only Section</span> (<input type="checkbox" class="sync" '+((text_both[tb].sync)? 'checked="checked"':'')+' name="sync['+text_both[tb].id+']" value="'+text_both[tb].id+'" />'+
                           '<label for="sync1" '+((text_both[tb].sync)?'class="text-success"':'')+'>Sync</label>) '+
                           '<button data-id="'+text_both[tb].id+'" type="button" class="btn btn-danger btn-sm deleteSubSection"><span class="glyphicon glyphicon-trash"></span> Delete</button><input type="hidden" name="deletedItem['+text_both[tb].id+']" value="0"/>'+
                           '</h3>';
                       htmlTxtBothContent+= englishOnlyHeader+'<textarea name="englishOnly['+text_both[tb].id+']" class="col-md-12">'+t+'</textarea><br/>';
                   }

               }


               var hebEngContent = ''; 
               for(te in text_eng_heb){
                   var heb = text_eng_heb[te].text_heb.trim();
                   var eng = text_eng_heb[te].text_eng.trim();
                   if(heb){
                      

                       hebEngContent += '<h3><span>Hebrew/English Section</span> (<input type="checkbox" '+((text_eng_heb[te].sync)? 'checked="checked"' : '')+' class="sync" name="sync['+text_eng_heb[te].id+']" value="'+text_eng_heb[te].id+'"/> <label for="sync2" '+((text_eng_heb[te].sync)? 'class="text-success"' : '')+'>Sync</label>) '+
                ' <button type="button" class="btn btn-danger btn-sm deleteSubSection" data-id="'+text_eng_heb[te].id+'">'+
                  '<span class="glyphicon glyphicon-trash"></span> Delete</button><input type="hidden" name="deletedItem['+text_eng_heb[te].id+']" value="0"/></h3><p>Hebrew:</p>'+
                '<textarea name="heb['+text_eng_heb[te].id+']">'+heb+'</textarea><p>English:</p>'+
                '<textarea name="eng['+text_eng_heb[te].id+']">'+eng+'</textarea>';

                      
                   }
               }
               

               $("#englishOnly").html(htmlTxtBothContent);
               $("#hebEng").html(hebEngContent); 

               tinymce.init({
                   mode:"none",
                   menubar: false,

                   plugins: "code",

                   toolbar: 'formatselect, fontselect, fontsizeselect, styleselect | cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, superscript | bold, italic, underline strikethrough, alignleft, aligncenter, alignright, alignjustify, code',

                   selector:'textarea'

               });
               $("#loader").addClass('hidden');
               $("#subSections").removeClass('hidden');
           }
        });
    });


    $("#sync_all").change(function(){
       var obj = $(this);
        if(obj.prop('checked')){
            $(".sync").prop('checked','checked');
            $(".sync").next().addClass('text-success');


        }else{
            $(".sync").removeAttr('checked');
            $(".sync").next().removeClass('text-success');

        }
    });

    $(document).on('change','input.sync',function(){
       var obj = $(this);
        if(obj.prop('checked')){
            obj.next().addClass('text-success');

        }else{

            obj.next().removeClass('text-success');
        }
    });


    $(document).on('click','button.deleteSubSection',function(){
        var obj = $(this);
        obj.next().val(obj.attr('data-id'));

        obj.parent().find('span').addClass('strike_through');
    });



    $("#addEngOnlyBtn").click(function(){
        var englishOnlyHeader = '<h3><span>English Only Section</span> (<input type="checkbox" class="sync" name="sync_new['+newItemCount+']" value="'+newItemCount+'" />'+
            '<label for="sync1">Sync</label>) '+
            '<button data-id="'+newItemCount+'" type="button" class="btn btn-danger btn-sm deleteSubSection"><span class="glyphicon glyphicon-trash"></span> Delete</button><input type="hidden" name="deletedItem_new['+newItemCount+']" value="0"/>'+
            '</h3><textarea name="englishOnlyNew['+newItemCount+']" class="col-md-12"></textarea><br/>';

        $("#newSubSection").append(englishOnlyHeader);
        tinymce.init({
            mode:"none",
            menubar: false,

            plugins: "code",

            toolbar: 'formatselect, fontselect, fontsizeselect, styleselect | cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, superscript | bold, italic, underline strikethrough, alignleft, aligncenter, alignright, alignjustify, code',

            selector:'textarea'

        });
        newItemCount++;
    });

    $("#addHebBtn").click(function(){
        var hebEngContent = '<h3><span>Hebrew/English Section</span> (<input type="checkbox" class="sync" name="sync_new['+newItemCount+']" value="'+newItemCount+'"/> <label for="sync2">Sync</label>) '+
            ' <button type="button" class="btn btn-danger btn-sm deleteSubSection" data-id="'+newItemCount+'">'+
            '<span class="glyphicon glyphicon-trash"></span> Delete</button><input type="hidden" name="deletedItem_new['+newItemCount+']" value="0"/></h3><p>Hebrew:</p>'+
            '<textarea name="heb_new['+newItemCount+']"></textarea><p>English:</p>'+
            '<textarea name="eng_new['+newItemCount+']"></textarea><br/>';

        $("#hebNewSubSection").append(hebEngContent);

        tinymce.init({
            mode:"none",
            menubar: false,

            plugins: "code",

            toolbar: 'formatselect, fontselect, fontsizeselect, styleselect | cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, superscript | bold, italic, underline strikethrough, alignleft, aligncenter, alignright, alignjustify, code',

            selector:'textarea'

        });
        newItemCount++;
    });

    $("#textSubmit").submit(function(){
        if($("#selectDay").val()==""){
            alert('please select day');
            return false;
        }
    });

</script>


@stop