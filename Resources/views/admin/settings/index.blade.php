@extends('admin::layouts.content')

@section('page_title')
   {{ __('doquot::app.settings.title')}} 
@stop

@section('content')
   @if ($errors->any())
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
      </ul>
   @endif

   @if (Session::has('flash_message'))
      <div>
         {{ Session::get('flash_message') }}
      </div>
   @endif
   
   <form action="{{ route('admin.doquot.settings.update') }}" method="POST">
      @csrf

      <div class="form-group">
         <h1>{{ __('doquot::app.settings.fields.require_approval_amount') }}</h1>   

         <select name="require_approval_total" class="control">
            @foreach($totals as $total)
               <option value="{{ $total->value }}" {{ $total->applied ? 'selected' : '' }}>{{ $total->value }}</option>   
            @endforeach
         </select>
      </div>
      <br>

      <button class="btn" type="submit">Apply</button>
   </form>
@stop