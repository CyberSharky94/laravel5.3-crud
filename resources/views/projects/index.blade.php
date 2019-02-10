@extends('layouts.container')

@section('container_body')

    @if (Session::has('success'))
        <div class="alert alert-success fade in">
            <p> {{ Session::get('success') }} 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
        </div>
    @endif

    @if (Session::has('success-danger'))
        <div class="alert alert-danger fade in">
            <p> {{ Session::get('success-danger') }} 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
        </div>
    @endif

    <div>
        <legend>Senarai Projek</legend>

        <div class="search-bar">
        
            {!! Form::open([
                'method' => 'GET',
                // 'action' => ['ProjectController@index', 'page' => $projects->currentPage()],
            ]) !!}

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-1 control-label" for="search">Carian</label>  
                    <div class="col-md-3">
                        <input id="search" name="search" type="text" placeholder="Carian" class="form-control input-md" required="" value="{{ $search_query }}">
                    </div>
                </div>
                
                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-4">
                        <button id="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
                        <button class="btn btn-warning" id="empty_btn" type="button" onclick="$('#search').val('');"><i class="glyphicon glyphicon-remove"></i></button>
                        <button class="btn btn-danger" type="button" id="reset_btn" onclick="window.location.href='{{url('projects')}}';"><i class="glyphicon glyphicon-repeat"></i></button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div><br><br><hr>
        

        <div class="button_section pull-right" style="margin-bottom:10px">
            <a href="{{url('projects/create')}}" class="btn btn-primary">Tambah Rekod</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>TAJUK PROJEK</th>
                    <th>TARIKH MULA</th>
                    <th>TARIKH TAMAT</th>
                    <th>DIREKODKAN OLEH</th>
                    <th>DIWUJUDKAN PADA</th>
                    <th>DIKEMASKINI PADA</th>
                    <th>TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                    $i = $i + (($projects->currentPage()-1) * $page_limit);
                @endphp
        
                @if (sizeof($projects) == 0)
                    <tr>
                        <td colspan="9"><i>Tiada rekod...</i></td>    
                    </tr>          
                @else
    
                @foreach ($projects as $project)

                <tr>
                    <td> {{ $i++ }} </td>
                    <td> {{ $project->id }} </td>
                    <td> {{ $project->proj_title }} </td>
                    <td> {{ date('d/m/Y',strtotime($project->proj_start_date)) }} </td>
                    <td> {{ date('d/m/Y',strtotime($project->proj_end_date)) }} </td>
                    <td> {{ $project->user('name') }} </td>
                    <td> {{ date('d/m/Y h:i:s A',strtotime($project->created_at)) }} </td>
                    <td> {{ date('d/m/Y h:i:s A',strtotime($project->updated_at)) }} </td>
                    <td class="table-action" width="20%">
                        {!! Form::open([
                            'method' => 'DELETE', 
                            'action' => ['ProjectController@destroy', $project->id], 
                            'onsubmit' => 'return confirm("Adakah anda pasti untuk membuang projek ini?");'
                        ]) !!}

                            <a href="{{ action('ProjectController@show', $project->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a> 
                            <a href="{{ action('ProjectController@edit', $project->id) }}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                            <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>

                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
    
                @endif
            </tbody>
        </table>

        <div class="paginator pull-right">
            {{ $projects->links() }}
        </div>
    </div>

@endsection