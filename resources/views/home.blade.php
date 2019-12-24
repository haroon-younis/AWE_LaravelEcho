@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">Messenger Application</div>

                <div class="panel-body" id="app"> <!-- Root of application -->
                    <chat-app :user="{{ auth()->user() }}"></chat-app>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
