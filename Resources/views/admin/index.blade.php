@extends('admin::layouts.content')

@section('page_title')
{{ __('doquot::app.doquot.title') }}
@stop

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h1>
                {{ __('doquot::app.doquot.dashboard') }}
            </h1>

            <p>Welcome</p>
        </div>
    </div>
@stop
