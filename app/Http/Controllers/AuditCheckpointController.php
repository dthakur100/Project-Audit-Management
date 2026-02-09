<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditCheckpoint;
use App\Models\AuditCategory;
class AuditCheckpointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index(Request $request)
// {
//     //Category
//     $categories = AuditCategory::all();

//     // Checkpoints list + category relation
//     $checkpoints = AuditCheckpoint::with('category')
//         ->when($request->category_id, function ($q) use ($request) {
//             $q->where('audit_category_id', $request->category_id);
//         })
//         ->get();

//     return view('checkpoints.index', compact('categories', 'checkpoints'));
// }

public function index(Request $request)
{
    $categories = AuditCategory::all();

    $checkpoints = AuditCheckpoint::withTrashed()
        ->when($request->category_id, function ($q) use ($request) {
            $q->where('audit_category_id', $request->category_id);
        })
        ->with('category')
        ->get();

    return view('checkpoints.index', compact('categories', 'checkpoints'));
}

    public function restore($id){
        $checkpoint = AuditCheckpoint::withTrashed()->findOrFail($id);
        $checkpoint->restore();
        return back()->with('success','Checkpoint Restored Successfully.');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AuditCategory::all();
        return view('checkpoints.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'audit_category_id'=>'required|exists:audit_categories,id',
            'title'=>'required',
            'description'=>'nullable|string',
        ]);
        AuditCheckpoint::create($request->all());
        return redirect()->route('checkpoints.index')->with('success','Checkpoint Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditCheckpoint $checkpoint)
    {
        $categories = AuditCategory::all();
        return view('checkpoints.edit',compact('categories','checkpoint'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, AuditCheckpoint $checkpoint)
{
    $request->validate([
        'audit_category_id' => 'required|exists:audit_categories,id',
        'title' => 'required|string|max:400',
        'description' => 'nullable|string',
    ]);

    $checkpoint->update($request->only([
        'audit_category_id',
        'title',
        'description'
    ]));

    return redirect()
        ->route('checkpoints.index')
        ->with('success', 'Checkpoint Updated Successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditCheckpoint $checkpoint)
    {
        $checkpoint->delete();
        return redirect()
        ->route('checkpoints.index')
        ->with('success','Checkpoint Deleted Successfuly');
    }

        public function indexByCategory(Request $request)
    {
        $categories = AuditCategory::all();

        $checkpoints = AuditCheckpoint::with('category')
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('audit_category_id', $request->category_id);
            })
            ->get();

        return view('checkpoints.index', compact('categories', 'checkpoints'));
    }

}
