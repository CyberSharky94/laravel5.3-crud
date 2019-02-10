@extends('layouts.container')

@section('container_body')
    
    <div>

        <legend>Papar Rekod Projek</legend>

        <table class="table table-bordered table-hover table-striped">
            <tbody>
                <tr>
                    <th>ID Projek: </th>
                    <td> {{ $project->id }} </td>
                </tr>
                <tr>
                    <th>Tajuk Projek: </th>
                    <td> {{ $project->proj_title }} </td>
                </tr>
                <tr>
                    <th>Tarikh Mula: </th>
                    <td> {{ $project->proj_start_date }} </td>
                </tr>
                <tr>
                    <th>Tarikh Tamat: </th>
                    <td> {{ $project->proj_end_date }} </td>
                </tr>
                <tr>
                    <th>Direkodkan Oleh: </th>
                    <td> {{ $project->user_id }} </td>
                </tr>
                <tr>
                    <th>Direkodkan Pada: </th>
                    <td> {{ $project->created_at }} </td>
                </tr>
                <tr>
                    <th>Dikemaskini Pada: </th>
                    <td> {{ $project->updated_at }} </td>
                </tr>

                <tr>
                    <th>Muat Turun Fail: </th>
                    <td><a href="{{ asset('storage/'.$project->filename) }}" target="_blank"><i class=".glyphicon-glyphicon-download-alt"></i> Klik Untuk Muat Turun</a></td>
                </tr>
            </tbody>
        </table>

    </div>

@endsection

