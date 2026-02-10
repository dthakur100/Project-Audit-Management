<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ProjectController extends Controller
{
    public function index(){
        // $projects = Project::latest()->paginate(15);
        // $projects = Project::with('audits')->latest()->paginate(15);
        $projects = Project::with('audits')->get();
        return view('projects.index',compact('projects'));
    }

    public function create(){
        return view('projects.create');
    }

    public function store(Request $request){
        try{
            $request->validate([
                'name' =>'required',
                'client_name'=>'required',
            ]);
            DB::beginTransaction();
            Project::create($request->all());
            DB::commit();
            return redirect()->route('projects.index')
            ->with('success','Project Created Successfully');
        }catch(\Throwable $e){
            DB::rollBack();
            Log::error('Project Creation Failed.',[
               'error_message' => $e->getMessage(),
               'file'=>$e->getFile(),
               'line'=>$e->getLine(),
               'user_id'=>auth()->id(),
            ]);
            //for custom error use error not errors
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    public function edit(Project $project){
        return view('projects.edit',compact('project'));
    }

    public function update(Request $request, Project $project){
        $project->update($request->all());
        return redirect()->route('projects.index')
        ->with('success','Project Updated SUccessfully');
    }
    public function destroy(Project $project){
        $project->delete();
        return redirect()->route('projects.index')
        ->with('success','Project Deleted Successfully');
    }

    //project status update method 
    public function updateStatus(Request $request, Project $project){
        $request->validate([
            'status'=>'required|in:active,in_progress,completed'
        ]);
        $project->update([
            'status' => $request->status
        ]);
        return response()->json(['success'=>true]);
    }


}
