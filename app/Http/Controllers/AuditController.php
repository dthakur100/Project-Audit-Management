<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\AuditCategory;
use App\Models\Audit;
use App\Models\AuditCheckpoint;
use App\Models\AuditResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuditController extends Controller
{
    // Show project & category selection UI
    public function start()
    {
        $projects = Project::WhereIn('status',['active','in_progress'])->get();
        $categories = AuditCategory::all();

        return view('audits.start', compact('projects', 'categories'));
    }

    // Create audit entry and move to checkpoint screen
    public function begin(Request $request)
    {
        try{
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'audit_category_id' => 'required|exists:audit_categories,id',
        ]);

        DB::beginTransaction();

        $audit = Audit::create([
            'project_id' => $request->project_id,
            'audit_date' => now(),
        ]);

        DB::commit();

        // next step: checkpoint evaluation
        return redirect()->route('audits.checkpoints', [
            'audit' => $audit->id,
            'category' => $request->audit_category_id
        ]);
        } catch(\Throwable $e){
            DB::rollBack();
            Log::error('Audit creation failed.',[
               'error_message' => $e->getMessage(),
               'file'=>$e->getFile(),
               'line'=>$e->getLine(),
               'project_id'=>$request->project_id,
               'user_id'=>auth()->id(),
            ]);
            //for custom error use error not errors
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    //it is checkpoint screen method
    public function checkpoints($auditId,$categoryId){
        $audit = Audit::FindOrFail($auditId);
        $checkpoints = AuditCheckpoint::where('audit_category_id',$categoryId)->get();
        return view('audits.checkpoints',compact('audit','checkpoints','categoryId'));
    }

    // public function saveResults(Request $request, $auditId){
    //     foreach($request->results as $checkpointId => $data){
    //         AuditResult::create([
    //             'audit_id'=> $auditId,
    //             'audit_checkpoint_id'=>$checkpointId,
    //             'status'=>$data['status'],
    //             'severity'=> $data['severity'] ?? null,
    //             'remarks'=> $data['remarks'] ?? null,
    //         ]);
    //     }
    //     return redirect()->route('projects.index')
    //     ->with('success','Audit Completed Successfully');
    // }

    public function saveResults(Request $request, $auditId)
    {
        try{
            $request->validate([
                'results' => 'required|array',
                'results.*.status' => 'required|string',
                'results.*.severity' => 'required|string',
                'results.*.remarks' => 'nullable|string',
            ]);

            DB::beginTransaction();
            foreach ($request->results as $checkpointId => $data) {
                AuditResult::create([
                    'audit_id' => $auditId,
                    'audit_checkpoint_id' => $checkpointId,
                    'status' => $data['status'],
                    'severity' => $data['severity'] ?? null,
                    'remarks' => $data['remarks'] ?? null,
                ]);
            }
            DB::commit();
            return redirect()->route('projects.index')
                ->with('success', 'Audit Completed Successfully');
        }
        catch(\Throwable $e){
            DB::rollBack();
            Log::error('Audit Result Creation Failed',[
                'error_message'=>$e->getMessage(),
                'file'=>$e->getFile(),
                'line'=>$e->getLine(),
                'audit_id'=>$auditId,
                'user_id'=>auth()->id(),
            ]);
        return back()->with('error', 'Something went wrong. Please try again.');

        }
    }

    //Audit Completed result view page method
     public function completedProjects(){
        // $projects = Project::latest()->paginate(15);
        // $projects = Project::with('audits')->latest()->paginate(15);
        $projects = Project::with('audits')->where('status',['completed'])->get();
        return view('audits.complete',compact('projects'));
    }
}