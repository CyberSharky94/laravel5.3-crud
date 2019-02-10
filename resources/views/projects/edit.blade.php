@extends('layouts.container')

@section('container_body')

<style>
    .help-block{
        display:none;
    }
</style>

  @if (Session::has('errors'))
  <div class="alert alert-danger fade in">
      <p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </p>
      <p>
          <ul>
              @foreach ($errors as $err)
                <li>{{ $err }}</li>
              @endforeach
          </ul>
      </p>
  </div>
@endif

  {!! Form::open([
    'method' => 'PATCH', 
    'action' => ['ProjectController@update',$id], 
    'class' => 'form-horizontal', 
    'enctype' => 'multipart/form-data'
  ]) !!}

      <fieldset>
      
      <!-- Form Name -->
      <legend>Kemaskini Rekod Projek</legend>
      
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="proj_title">Tajuk Projek</label>  
        <div class="col-md-4">
        <input id="proj_title" name="proj_title" type="text" placeholder="Tajuk Projek" class="form-control input-md" required="" value="{{ $project->proj_title }}">
        <span class="help-block">help</span>  
        </div>
      </div>
      
      <!-- Date input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="proj_start_date">Tarikh Mula</label>  
        <div class="col-md-4">
        <input id="proj_start_date" name="proj_start_date" type="date" placeholder="Tarikh Mula" class="form-control input-md" required="" value="{{ $project->proj_start_date }}">
        <span class="help-block">help</span>  
        </div>
      </div>
      
      <!-- Date input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="proj_end_date">Tarikh Tamat</label>  
        <div class="col-md-4">
        <input id="proj_end_date" name="proj_end_date" type="date" placeholder="Tarikh Tamat" class="form-control input-md" required="" value="{{ $project->proj_end_date }}">
        <span class="help-block">help</span>  
        </div>
      </div>

      <!-- File Button --> 
      <div class="form-group">
        <label class="col-md-4 control-label" for="filename">Muat Naik Fail</label>
        <div class="col-md-4">
          <input id="filename" name="filename" class="input-file" type="file" required>
        </div>
      </div>
      
      <!-- Button (Double) -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-8">
          <button id="submit" name="submit" class="btn btn-primary">Hantar</button>
          <button type="reset" id="reset" name="reset" class="btn btn-warning">Isi Semula</button>
        </div>
      </div>
      
      </fieldset>
      
  {!! Form::close() !!}

@endsection