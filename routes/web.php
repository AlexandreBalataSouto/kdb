<?php

use Illuminate\Support\Facades\Route;


Route::get("/","WelcomeController@welcome")->name('welcome');

Route::middleware(['auth'])->group(function(){

    Route::get("/karatecas/trash","KaratecaController@trashKarateca")->name("viewTrashKarateca");
    Route::resource("/karatecas","KaratecaController");
    Route::post("/delete_ajax_karateca","KaratecaController@deleteAjaxKarateca")->name("deleteAjaxKarateca");
    Route::post("/restore_ajax_karateca","KaratecaController@restoreAjaxKarateca")->name("restoreAjaxKarateca");
   
    Route::get("/monitores/trash","MonitorController@trashMonitor")->name("viewTrashMonitor");
    Route::resource("/monitores","MonitorController");
    Route::post("/delete_ajax_monitor","MonitorController@deleteAjaxMonitor")->name("deleteAjaxMonitor");
    Route::post("/restore_ajax_monitor","MonitorController@restoreAjaxMonitor")->name("restoreAjaxMonitor");

    Route::get('/fotos_karateca/{id}','FotoKaratecaController@index')->name('fotosKaratecaIndex');
    Route::post('/fotos_karateca/upload/{id}','FotoKaratecaController@store')->name('fotosKaratecaStore');
    Route::get('/fotos_karateca/download/{id}','FotoKaratecaController@download')->name('fotosKaratecadownload');
    Route::get('/refresh_ajax_foto_karateca/{id}','FotoKaratecaController@refresh')->name('refreshAjaxFotoKarateca');
    Route::post('/delete_ajax_foto_karateca','FotoKaratecaController@deleteAjaxFotoKarateca')->name('deleteAjaxFotoKarateca');
    Route::get('pagination_karateca/fetch_data', 'FotoKaratecaController@fotosKaratecaPagination')->name('fotosKaratecaPagination');

    Route::get('/fotos_monitor/{id}','FotoMonitorController@index')->name('fotosMonitorIndex');
    Route::post('/fotos_monitor/upload/{id}','FotoMonitorController@store')->name('fotosMonitorStore');
    Route::get('/fotos_monitor/download/{id}','FotoMonitorController@download')->name('fotosMonitordownload');
    Route::get('/refresh_ajax_foto_monitor/{id}','FotoMonitorController@refresh')->name('refreshAjaxFotoMonitor');
    Route::post('/delete_ajax_foto_monitor','FotoMonitorController@deleteAjaxFotoMonitor')->name('deleteAjaxFotoMonitor');
    Route::get('pagination_monitor/fetch_data', 'FotoMonitorController@fotosMonitorPagination')->name('fotosMonitorPagination');

    Route::get('/documentos/{id}','DocumentoController@index')->name('documentosIndex');
    Route::post('/documentos/upload/{id}','DocumentoController@store')->name('documentosStore');
    Route::get('/documentos/download/{id}','DocumentoController@download')->name('documentosdownload');
    Route::get('/refresh_ajax_documento/{id}','DocumentoController@refresh')->name('refreshAjaxDocumento');
    Route::post('/delete_ajax_documento','DocumentoController@deleteAjaxDocumento')->name('deleteAjaxDocumento');
    Route::get('pagination_documento/fetch_data','DocumentoController@documentosPagination')->name('documentosPagination');

    Route::resource("/faltas","FaltaController");
    Route::post('/add_ajax_falta','FaltaController@addAjaxFalta')->name('addAjaxFalta');
    Route::get('/get_ajax_falta','FaltaController@getAjaxFalta')->name('getAjaxFalta');
    Route::post('/update_ajax_falta','FaltaController@updateAjaxFalta')->name('updateAjaxFalta');
    Route::post('/delete_ajax_falta','FaltaController@deleteAjaxFalta')->name('deleteAjaxFalta');

    Route::get('/eventos','EventoController@index')->name('eventos.index');
    Route::get('/get_ajax_evento','EventoController@getAjaxEvento')->name('getAjaxEvento');

    Route::post('/create_ajax_curso','CursoController@createAjaxCurso')->name('createAjaxCurso');
    Route::post('/create_ajax_competicion','CompeticionController@createAjaxCompeticion')->name('createAjaxCompeticion');
    Route::post('/update_ajax_curso','CursoController@updateAjaxCurso')->name('updateAjaxCurso');
    Route::post('/update_ajax_competicion','CompeticionController@updateAjaxCompeticion')->name('updateAjaxCompeticion');
    Route::post('/update_ajax_curso_drop_resize','CursoController@updateAjaxCursoDropResize')->name('updateAjaxCursoDropResize');
    Route::post('/update_ajax_competicion_drop_resize','CompeticionController@updateAjaxCompeticionDropResize')->name('updateAjaxCompeticionDropResize');
    Route::post('/delete_ajax_curso','CursoController@deleteAjaxCurso')->name('deleteAjaxCurso');
    Route::post('/delete_ajax_competicion','CompeticionController@deleteAjaxCompeticion')->name('deleteAjaxCompeticion');

    Route::get('/cursos/{id}','CursoController@indexParticipantes')->name('indexParticipantes');
    Route::post('/add_ajax_participantes_curso','CursoController@addAjaxParticipantesCurso')->name('addAjaxParticipantesCurso');
    Route::get('/refresh_ajax_participantes_curso/{id}','CursoController@refreshAjaxParticipantesCurso')->name('refreshAjaxParticipantesCurso');
    Route::post('/delete_ajax_participantes_curso','CursoController@deleteAjaxParticipantesCurso')->name('deleteAjaxParticipantesCurso');

    Route::get('/competiciones/{id}','CompeticionController@indexCompetidores')->name('indexCompetidores');
    Route::post('/add_ajax_competidores_competicion','CompeticionController@addAjaxCompetidoresCompeticion')->name('addAjaxCompetidoresCompeticion');
    Route::get('/refresh_ajax_competidores_competicion/{id}','CompeticionController@refreshAjaxCompetidoresCompeticion')->name('refreshAjaxCompetidoresCompeticion');
    Route::post('/delete_ajax_competidores_competicion','CompeticionController@deleteAjaxCompetidoresCompeticion')->name('deleteAjaxCompetidoresCompeticion');
    Route::post('/update_ajax_puesto_competidor','CompeticionController@updateAjaxPuestoCompetidor')->name('updateAjaxPuestoCompetidor');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
