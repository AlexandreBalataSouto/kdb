@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s9 m9 l9">
                <span class="card-title" data-id="{{$karateca->id_karateca}}">Faltas de {{$karateca->nombre}}
                    {{$karateca->apellidos}}</span>
            </div>
            <div class="col s3 m3 l3">
                <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                    href="{{route('faltas.index')}}" data-position="left" data-tooltip="Volver al listado de faltas">
                    <i class="material-icons">undo</i>
                </a>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
                <div id="calendar"></div>
            </div>
        </div>

        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>
    </div>
</div>

<div class="modal" id="modalFalta">
    <div class="modal-content">
        <div class="row">
            <div class="col s11 m11 l11">
                <h5>¿Borrar esta falta?</h5>
                <p>Fecha seleccionada: <strong class="faltaTitle"></strong></p>
            </div>
            <div class="col s1 m1 l1">
                <a href="#" class="closeModal"><i class="material-icons">close</i></a>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="waves-effect waves-light btn red" id="botonBorrarFalta"><i
                class="material-icons">delete</i></a>
        <input type="hidden" class="inputFaltaId">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let dateSettings = { "year": "numeric", "month": "2-digit", "day": "2-digit" }; //Configuracion previa para el formato fecha
        let id_karateca = $(".card-title").data("id");

        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });

        let calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [dayGridPlugin,interactionPlugin],
            height: 'auto',
            contentHeight:'auto',
            firstDay:1,
            events: {
                url:"{{route('getAjaxFalta')}}",
                method:"GET",
                extraParams:{
                    id_karateca:id_karateca
                },
              failure:function(){
                toastr.error('ERROR CALENDAR');
              },
          },
          headerToolbar:{
            start: 'title',
            center: '',
            end: 'today,prev,next'
          },
          buttonText:{
            today: 'Hoy',
          },
          eventStartEditable:true,

          eventClick:function(info){
            let startdate = calendar.formatDate(info.event.start,  dateSettings); //Cambiamos el formato de la fecha a dd/mm/YYYY
            $(".faltaTitle").text(startdate);
            $(".inputFaltaId").val(info.event.extendedProps.id_falta);
            $('.modal').modal('open', modalFalta);
          },
          eventDrop:function(info){
            let newDate = calendar.formatDate(info.event.start, dateSettings)
            let id_falta = info.event.extendedProps.id_falta;

            $.ajax({
                type:"POST",
                url:"{{route('updateAjaxFalta')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    newDate: newDate,
                    id_falta: id_falta,
                },
                success: function(){
                    toastr.success('Falta editada');
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
          },
        });

        calendar.setOption('locale','Es');
        calendar.render();
        
        $(".closeModal").click(function(){
            $('.modal').modal('close', modalFalta);
        });

        $("#botonBorrarFalta").click(function(){
            let id_falta = $(".inputFaltaId").val();
            
            $.ajax({
                type:"POST",
                url:"{{route('deleteAjaxFalta')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    id_falta: id_falta
                },
                success: function($numeroKaratecas){
                    toastr.success('Falta eliminada');
                    $('.modal').modal('close', modalFalta);
                    calendar.refetchEvents();
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
        });

    });
</script>

@endsection