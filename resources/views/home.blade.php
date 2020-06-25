@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12 m12 l2"></div>
    <div class="col s12 m12 l8">
        <div class="card">
            <div class="row card-content">
                <span class="card-title">{{ __('You are logged in!') }}</span>
                <div class="divider"></div>

                <div class="col s12">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    A continuacion sera redirigido para crear su ficha de monitor.
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m12 l2"></div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) { 
    setTimeout(function()
    { 
        window.location = "{{route('monitores.create')}}";
    
    }, 3000);
});
</script>
@endsection