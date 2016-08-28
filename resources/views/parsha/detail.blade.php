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
        <form class="form-horizontal" action="{{url('text/save')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="parsha_id" value="{{$parsha->id}}"/>
        <h3>Add/Edit text for {{$parsha->parsha_name}} {{$parsha->id}}</h3>
        <div class="form-group">
            <label class="control-label col-md-1"><strong>Section</strong>:</label>
            <div class="col-md-3">
                <select name="section" style="padding:10px;" id="selectSection">
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
                <select name="day_num" style="padding: 10px;" id="selectDay">
                    <option>Please Select</option>
                </select>
            </div>
        </div>
            <p><input type="checkbox" id="sync_all"> <label for="sync_all">Sync all rows in this section/day</label></p>
            <h3><span>English Only Section</span> (<input type="checkbox" class="sync" name="sync_both" id="sync1">
                <label for="sync1">Sync</label>)
                <button id="deleteBoth" type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button>
            </h3>
            <div id="englishOnly" class="tanya_textarea" >

                <!--<h3 style="text-align:center;">Overview of Chapter 7</h3>
                <p style="font-style:italic;"></p>A true path of Teshuvah requires these two processes: (1) arousing mercy on one’s soul’s descent – and thereby, the Shechinah’s too; (2) crushing the arrogant spirit. The latter is achieved by an honest and thorough reflection and accounting of one’s wrongdoings.</p>

                <h1 style="text-align:center">פֶּרֶק ז</h1>
                <h2 style="text-align:center;">CHAPTER SEVEN</h2>

                    <p>The Flow: In the language of the Zohar, the lower level of repentance entails returning the latter hey of the Four-Letter Name of G-d to its rightful place—returning the Shechinah, which is the source of Jewish souls, from the exile to which it was banished by transgression. For when a man sins, the Divine vitality that flows forth from the Shechinah descends into the chambers of kelipah and sitra achara, and from there, that individual in turn derives nurture at the time of his sins. Repentance redeems the Shechinah from its exile and returns the flow to its proper place.</p>

                    <p>This was the theme of the previous chapter.</p>-->

            </div>
            <input type="hidden" name="englishOnlyStart" value="0"/>

            <hr>

            <h3><span>Hebrew/English Section</span> (<input type="checkbox" class="sync" name="sync_ind" id="sync2"> <label for="sync2">Sync</label>)
                <button id="deleteHebEng" type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button></h3>

            <p>Hebrew:</p>

            <div id="hebText" class="tanya_textarea">
                <!--<span dir="rtl" style="text-align:right;float:right;font-size:20px;">ְאוּלָם, דֶּרֶךְ הָאֱמֶת וְהַיָּשָׁר לִבְחִינַת תְּשׁוּבָה תַּתָּאָה, הֵ"א תַּתָּאָה הַנִּזְכֶּרֶת לְעֵיל – הֵם ב' דְּבָרִים דֶּרֶךְ כְּלָל.
                </span>-->
            </div>
            <input type="hidden" name="hebStart" value="0"/>

            <p>English:</p>
            <div id="engText" class="tanya_textarea">
                <!--<span style="font-size:15px;">However, the true and direct path to the lower level of teshuvah, returning the latter hey as noted above, involves two general elements.</span>-->
            </div>
            <input type="hidden" name="engStart" value="0"/>
            <hr>

            <!--<h3>English only section (<input type="checkbox" name="sync" id="sync3" checked> <label for="sync3" style="color:green">Sync</label>) <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button></h3>

            <div class="tanya_textarea" style="height:250px;">
                <span style="font-size:15px;">Not merely from a rooftop but from a “lofty rooftop”; not merely into a pit, but into a “deep pit.”</span>
            </div>

            <br><br>-->

            <button class="btn btn-default btn-lg" href='#'><span class="glyphicon glyphicon-plus"></span> Add Hebrew/English Section</button>


            <button class="btn btn-default btn-lg" href='#'><span class="glyphicon glyphicon-plus"></span> Add English only summary section</button>


            <br><br>


            <button class="btn btn-primary btn-lg center-block" type="submit"><span class="glyphicon glyphicon-ok"></span> Save & Preview Tanya</button>

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

        selector:'#englishOnly'

    });

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

    var getDays = function(id){
        var token = "{{csrf_token()}}";
        $.ajax({
            type:"POST",
            url:"{{url('ajax-get-days')}}",
            data: {section_id:id,_token:token},
            success:function(e){
                var data = JSON.parse(e);
                var days = data.days;

                var optionHtml ='<option>Please Select</option>';
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
               $("#englishOnly").html('');
               $("#hebText").html('');
               $("#engText").html('');
               /*tinymce.execCommand('mceRemoveEditor',true,'.tanya_textarea');*/
           },
           success:function(e){


               var data= JSON.parse(e);
               var text_both = data.text_both;
               var text_eng  = data.text_eng;
               var text_heb = data.text_heb;

               var htmlTxtBothContent = '';
               var htmlTxtEng = '';
               var htmlTxtHeb = '';
               var startBoth = 0;
               var startHeb = 0;
               var startEng = 0;
               var hebTotal = 0;
               var hebSyncCount = 0;
               var bothTotal = 0;
               var bothSyncCount = 0;
               for(tb in text_both){

                   var t = text_both[tb].text_both.trim();
                   if(t != ""){
                       bothTotal++;
                       if(text_both[tb].sync==1){
                           bothSyncCount++;
                       }
                       if(startBoth==0){
                           startBoth = text_both[tb].id;
                       }else{
                           startBoth += "," + text_both[tb].id;
                       }

                       htmlTxtBothContent+='<p>'+t+'</p>';

                   }

               }

               for(te in text_eng){
                   var t = text_eng[te].text_eng.trim();
                   if(t){
                       if(text_eng[te].sync==1){

                       }
                       if(startEng==0){
                           startEng = text_eng[te].id;
                       }else{
                           startEng += "," + text_eng[te].id;
                       }
                       htmlTxtEng += '<p>'+t+'</p>';
                   }
               }
               for(th in text_heb){
                   var t = text_heb[th].text_heb.trim();
                   if(t){
                       hebTotal++;
                       if(text_heb[th].sync==1){
                           hebSyncCount++;
                       }
                       if(startHeb==0){
                           startHeb = text_heb[th].id;
                       }else{
                           startHeb += "," + text_heb[th].id;
                       }
                       htmlTxtHeb += '<p>'+t+'</p>';
                   }
               }

               if(hebTotal == hebSyncCount){
                   $("#sync1").prop('checked','checked');
                   $("#sync1").next().addClass('text-success');
               }

               if(hebTotal == hebSyncCount){
                   $("#sync2").prop('checked','checked');
                   $("#sync2").next().addClass('text-success');
               }

               if($("#sync1").prop('checked') && $("#sync2").prop('checked')){
                   $("#sync_all").prop('checked','checked');
               }

               $("#englishOnly").html(htmlTxtBothContent);
               $("input[name=englishOnlyStart]").val(startBoth);

               $("#hebText").html(htmlTxtHeb);
               $("input[name=hebStart]").val(startHeb);

               $("#engText").html(htmlTxtEng);
               $("input[name=engStart]").val(startEng);

                tinymce.get('englishOnly').setContent(htmlTxtBothContent);
                tinymce.get('hebText').setContent(htmlTxtHeb);
                tinymce.get('engText').setContent(htmlTxtEng);


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

    $("#deleteHebEng").click(function(){
        var obj = $(this);

        obj.parent().find('span').addClass('strike_through');
    });

    $("#deleteBoth").click(function(){
        var obj = $(this);

        obj.parent().find('span').addClass('strike_through');
    });


</script>


@stop