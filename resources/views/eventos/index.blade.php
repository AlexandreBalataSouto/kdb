@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s12 m12 l12">
                <span class="card-title">Calendario de eventos</span>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="col s12 m12 l12">
                <div id="calendar"></div>
            </div>
        </div>

        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>

        <!---Modal eventos-->
        <div class="modal" id="modalEvento">
            <div class="modal-content">
                <div class="row">
                    <div class="col s10 m11 l11">
                        <h5 class="modalTitleEvento"></h5>
                        <input type="hidden" id="id_evento">
                    </div>
                    <div class="col s2 m1 l1">
                        <a href="#" class="closeModal"><i class="material-icons">close</i></a>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="input-field col s12 m6 l6" id="sectionTipoEvento">
                        <label for="evento"><span class="requiredInput">*</span></label>
                        <select id="tipoEvento" name="tipoEvento" class="browser-default">
                            <option value="" disabled>Selecciona un evento</option>
                            <option value="curso">Curso</option>
                            <option value="competicion">Competicion</option>
                        </select>
                        <strong class="errorValidation" id="errorTipoEvento"></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input type="text" id="title" name="title">
                        <label for="title"><span class="requiredInput">*</span>Nombre del evento</label>
                        <strong class="errorValidation" id="errorTitle"></strong>
                    </div>
                    <div class="input-field col s12 m6 l6" id="sectionId_monitor">
                        <label for="monitor_id"><span class="requiredInput">*</span></label>
                        <select id="monitor_id" name="monitor_id" class="browser-default">
                            <option value="0" disabled>Seleccione un monitor</option>
                            @foreach ($monitores as $monitor)
                            <option value="{{$monitor->id_monitor}}">{{$monitor->nombre_completo}}</option>
                            @endforeach
                        </select>
                        <strong class="errorValidation" id="errorMonitor"></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input type="date" id="start" name="start">
                        <label for="start"><span class="requiredInput">*</span>Fecha inicio</label>
                        <strong class="errorValidation" id="errorStart"></strong>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <input type="date" id="end" name="end">
                        <label for="end"><span class="requiredInput">*</span>Fecha fin</label>
                        <strong class="errorValidation" id="errorEnd"></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input type="time" id="hora" name="hora">
                        <label for="hora"><span class="requiredInput">*</span>Hora del evento</label>
                        <strong class="errorValidation" id="errorHora"></strong>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <input type="text" id="precio" name="precio">
                        <label for="precio">Precio del evento</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <textarea id="descripcion" name="descripcion" class="materialize-textarea"></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <button class="btn waves-effect waves-light" id="botonCrearEvento">Crear evento</button>
                        <a href="#" class="waves-effect waves-light btn blue floatLeft" id="botonParticipantesEvento">Participantes</a>
                        <button class="btn waves-effect waves-light" id="botonEditarEvento">Actualizar</button>
                        <button class="btn waves-effect waves-light red" id="botonBorrarEvento"><i class="material-icons">delete</i></button>
                    </div>
                </div>
            </div>
            <div class="boxGifLoading">
                <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let calendarEl = document.getElementById('calendar');

        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });
        
        let calendar = new FullCalendar.Calendar(calendarEl,{
            plugins: ['dayGrid','interaction'],
            height: 'auto',
            contentHeight:'auto',
            firstDay:1,
            events: {
              url:"{{route('getAjaxEvento')}}",
              method:"GET",
              failure:function(){
                toastr.error('ERROR CALENDAR');
              },
            },
            header:{
              left:'title',
              right:'prev,next today',
            },
            buttonText:{
                today: 'Hoy',
            },
            editable: true,
            dateClick:function(info){ //Mostramos el modal para Crear Evento
                clearFormEvento();
                clearFormErrores()
                $(".requiredInput").show();
                $(".modalTitleEvento").text("Crear Evento");
                $("#start").val(info.dateStr);
                $("#botonEditarEvento").hide();
                $("#botonBorrarEvento").hide();
                $("#botonParticipantesEvento").hide();
                $("#botonCrearEvento").show();
                $('.modal').modal('open', modalEvento);
            },
            eventClick:function(info){ //Mostramos los datos en el modal Mostrar Evento
                clearFormErrores()
                $(".requiredInput").hide();
                $(".modalTitleEvento").text(info.event.title);
                $("#sectionTipoEvento").hide();

                if(info.event.extendedProps.monitor_id != null){ //Si el evento tiene un id_monitor significa que es un curso 
                    $("#id_evento").val(info.event.extendedProps.id_curso);
                    $("#sectionId_monitor").show();
                    $("#monitor_id option").removeAttr("selected");
                    $("#monitor_id option[value="+info.event.extendedProps.monitor_id+"]").prop("selected","selected"); 

                    //Ruta para los participantes
                    $("#botonParticipantesEvento").show();
                    let route = "{{route('indexParticipantes',':id')}}";
                    route = route.replace(':id',info.event.extendedProps.id_curso);
                    $("#botonParticipantesEvento").attr("href",route);

                }else{

                    $("#id_evento").val(info.event.extendedProps.id_competicion);
                    $("#sectionId_monitor").hide();

                    //Ruta para los participantes
                    $("#botonParticipantesEvento").show();
                    let route = "{{route('indexCompetidores',':id')}}";
                    route = route.replace(':id',info.event.extendedProps.id_competicion);
                    $("#botonParticipantesEvento").attr("href",route);
                }

                $("#title").val(info.event.title);
                $("#precio").val(info.event.extendedProps.precio);
                $("#start").val(moment(info.event.start).format("YYYY-MM-DD"));
                $("#end").val(moment(info.event.end).format("YYYY-MM-DD"));
                $("#hora").val(info.event.extendedProps.hora);

                $("#descripcion").val(info.event.extendedProps.descripcion);

                M.textareaAutoResize($("#descripcion"));
                M.updateTextFields();

                $("#botonEditarEvento").show();
                $("#botonBorrarEvento").show();
                $("#botonCrearEvento").hide();

                $('.modal').modal('open', modalEvento);
            },
            eventDrop:function(info){
                getInfoUpdateAjaxEventoDate(info);
          },
            eventResize: function(info){
                getInfoUpdateAjaxEventoDate(info);
          }
        });

        calendar.setOption('locale','Es');
        calendar.render();

        //Botones
        $("#botonCrearEvento").click(function(){ 
            getEventoData("botonCrearEvento","crear");
        });
        $("#botonEditarEvento").click(function(){ 
            getEventoData("botonEditarEvento","editar");
        });
        $("#botonBorrarEvento").click(function(){
            let id_evento = $("#id_evento").val();
            if(id_evento.includes("a")){
                route = "{{route('deleteAjaxCurso')}}"
            }else{
                route = "{{route('deleteAjaxCompeticion')}}"
            }
            deleteEvento(id_evento, route);
        });

        function getEventoData(boton,accion){ //funcion para recoger los datos del modal tanto para Crear como Actualizar
            let evento = $("#tipoEvento").val(); //Si editamos esto esta nulo TAL VEZ SERA MEJOR SEPARAR ESTO
            let id_evento = $("#id_evento").val();

            if(id_evento != null && accion == "editar"){
                evento = "";
            }

            let monitor_id;
            let color;
            let route;

            if(accion == "crear"){
                if(id_evento.includes("a") || evento == "curso"){
                    monitor_id = $("#monitor_id").val();
                    color = "#0000FF";
                    route = "{{route('createAjaxCurso')}}";
                }else{
                    color = "#04B404";
                    route = "{{route('createAjaxCompeticion')}}";
                }
            }else{
                if(id_evento.includes("a") || evento == "curso"){
                    monitor_id = $("#monitor_id").val();
                    color = "#0000FF";
                    route = "{{route('updateAjaxCurso')}}";
                }else{
                    color = "#04B404";
                    route = "{{route('updateAjaxCompeticion')}}";
                }
            }

            nuevoEvento = {
                evento: evento,
                title: $("#title").val(),
                start: $("#start").val(),
                end: $("#end").val(),
                hora: $("#hora").val(),
                precio: $("#precio").val(),
                descripcion: $("#descripcion").val(),
                color: color,
                text_color: "#FFFFFF",
                monitor_id: monitor_id,
            }

            if(boton == "botonCrearEvento"){
                createEvento(nuevoEvento,route);
            }else{
                updateEvento(nuevoEvento, id_evento,route);
            }
        }

        function createEvento(nuevoEvento,route){ //Llamada de ajax para guardar el evento
            $.ajax({
                type:"POST",
                url:route,
                data:{
                    _token: "{{csrf_token()}}",
                    evento:nuevoEvento
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.notification);
                        $('.modal').modal('close', modalEvento);
                        calendar.refetchEvents();
                    }else{
                        toastr.error('Hay errores en el formulario');
                        clearFormErrores();
                        $("#errorTipoEvento").text(data.error['evento.evento']);
                        $("#errorTitle").text(data.error['evento.title']);
                        $("#errorStart").text(data.error['evento.start']);
                        $("#errorEnd").text(data.error['evento.end']);
                        $("#errorHora").text(data.error['evento.hora']);
                        $("#errorMonitor").text(data.error['evento.monitor_id']);
                    }
                }
            }).fail(function(data){
                clearFormErrores();
                toastr.error('Hay errores en el formulario');
            });
        }

        function updateEvento(nuevoEvento,id_evento,route){

            $.ajax({
                type:"POST",
                url:route,
                data:{
                    _token: "{{csrf_token()}}",
                    evento:nuevoEvento,
                    id_evento: id_evento
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.notification);
                        $('.modal').modal('close', modalEvento);
                        calendar.refetchEvents();
                    }else{
                        toastr.error('Hay errores en el formulario');
                        clearFormErrores();
                        $("#errorTitle").text(data.error['evento.title']);
                        $("#errorStart").text(data.error['evento.start']);
                        $("#errorEnd").text(data.error['evento.end']);
                        $("#errorHora").text(data.error['evento.hora']);
                        $("#errorMonitor").text(data.error['evento.monitor_id']);
                    }
                    
                }
            }).fail(function(){
                toastr.error('ERROR UPDATE EVENTO');
            });
        }

        function deleteEvento(id_evento,route){
            $.ajax({
                type:"POST",
                url:route,
                data:{
                    _token: "{{csrf_token()}}",
                    id_evento: id_evento
                },
                success: function(data){
                    toastr.success(data.notification);
                    $('.modal').modal('close', modalEvento);
                    calendar.refetchEvents();
                }
            }).fail(function(){
                toastr.error('Hay participantes en este evento, si desea eliminarlo primero borre a los participantes');
            });
        }

        function clearFormEvento(){ //Limpiar el formulario 
            
            $("#sectionTipoEvento").show();
            $("#id_evento").val("");
            $('#tipoEvento').prop('selectedIndex',0);
            $("#title").val("");
            $("#start").val("");
            $("#end").val("");
            $("#hora").val("");
            $("#precio").val("");
            $("#descripcion").val("");
            M.textareaAutoResize($("#descripcion"));
            $("#monitor_id option[value='0']").attr("selected",true);
            M.updateTextFields();
        }

        function clearFormErrores(){ //Limpiar el formulario de errores
            $("#errorTipoEvento").text("");
            $("#errorTitle").text("");
            $("#errorStart").text("");
            $("#errorEnd").text("");
            $("#errorHora").text("");
            $("#errorMonitor").text("");
        }

        function getInfoUpdateAjaxEventoDate(info){ //Funcion para eventDrop y eventResize
            let newStart =  moment(info.event.start).format("YYYY-MM-DD");
            let newEnd = moment(info.event.end).format("YYYY-MM-DD");
            let id_evento;
            let route;

            if(info.event.extendedProps.monitor_id != null){
                id_evento = info.event.extendedProps.id_curso;
                route = "{{route('updateAjaxCursoDropResize')}}";
            }else{
                id_evento = info.event.extendedProps.id_competicion;
                route = "{{route('updateAjaxCompeticionDropResize')}}"
            }

            $.ajax({
                type:"POST",
                url:route,
                data:{
                    _token: "{{csrf_token()}}",
                    newStart: newStart,
                    newEnd: newEnd,
                    id_evento: id_evento,
                },
                success: function(data){
                    toastr.success(data.notification);
                }
            }).fail(function(){
                toastr.error('ERROR Fecha del evento');
            });
        }

        $(".closeModal").click(function(){ //Cerrar modal al hacer click sobre la X
            $('.modal').modal('close', modalEvento);
        });

        $("#tipoEvento").change(function(){ //Para ocultar el select monitor si seleccionamos competicion
            if($("#tipoEvento").val() == "curso"){
                $("#sectionId_monitor").show();
            }else{
                $("#sectionId_monitor").hide();
            }
        });
    });
</script>
@endsection