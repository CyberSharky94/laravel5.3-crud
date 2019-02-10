<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Project;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_limit = 3;
        $search_query = null;

        if($request->query('search') !== null)
        {
            $search_query = $request->query('search');
            $projects = $this->search($search_query, $page_limit);
            $projects->appends($request->only('search'));
        } else {
            $projects = Project::paginate($page_limit);
        }

        return view('projects.index', compact('projects', 'page_limit', 'search_query'));
    }

    private function search($search_query, $page_limit)
    {
        if(!isset($search_query) || empty($search_query))
        {
            $projects = null;
        } else {
            $projects = Project::where('proj_title', 'LIKE', '%'.$search_query.'%')
                ->paginate($page_limit);
        }

        return $projects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validation Method
        $validator = Validator::make($request->all(), [
            'proj_title' => 'required',
            'proj_start_date' => 'required',
            'proj_end_date' => 'required',
        ]);
        
        if($validator->fails())
        {
            $errors = $validator->errors()->all();
            return back()->with('errors', $errors)->withInput();
        }
        // END: Validation Method
        
        $projects = new Project();
        
        if($request->hasfile('filename'))
        {
            $directory = 'file_upload';

            $file = $request->file('filename'); // fetch file

            // Rename process
            $original_filename = $file->getClientOriginalName(); // eg; test_upload.txt
            $original_extension = $file->getClientOriginalExtension(); // eg: .jpeg
            $filename=time().uniqid().'.'.$original_extension;

            $file->storeAs('public/'.$directory, $filename); // Store file

            $projects->filename = $directory.'/'.$filename; // Save filename into database
        }

        $projects->proj_title = $request->get('proj_title');
        $projects->proj_start_date = $request->get('proj_start_date');
        $projects->proj_end_date = $request->get('proj_end_date');
        $projects->user_id = $user->id;
        $projects->save();

        return redirect('projects')->with('success', 'Maklumat projek telah direkodkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        // $sql = $project->toSql();
        
        return view('projects.show', compact('project', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $project = Project::find($id);

        return view('projects.edit', compact('project', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Validation Method
        $validator = Validator::make($request->all(), [
            'proj_title' => 'required',
            'proj_start_date' => 'required',
            'proj_end_date' => 'required',
        ]);
        
        if($validator->fails())
        {
            $errors = $validator->errors()->all();
            return back()->with('errors', $errors)->withInput();
        }
        // END: Validation Method

        $projects = Project::find($id);

        $projects->proj_title = $request->get('proj_title');
        $projects->proj_start_date = $request->get('proj_start_date');
        $projects->proj_end_date = $request->get('proj_end_date');
        $projects->user_id = $user->id;

        if($request->hasfile('filename'))
        {
            $directory = 'file_upload';

            $file = $request->file('filename'); // fetch file

            // Rename process
            $original_filename = $file->getClientOriginalName(); // eg; test_upload.txt
            $original_extension = $file->getClientOriginalExtension(); // eg: .jpeg
            $filename=time().uniqid().'.'.$original_extension;

            $file->storeAs('public/'.$directory, $filename); // Store file

            $projects->filename = $directory.'/'.$filename; // Save filename into database
        }

        $projects->save();

        return redirect('projects')->with('success', 'Maklumat projek telah dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('projects')->with('success-danger', 'Rekod projek telah dibuang.');
    }
}
