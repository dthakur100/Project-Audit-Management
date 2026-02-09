<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditCheckpoint;
use App\Models\AuditCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AuditCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = AuditCategory::latest()->get();
        $categories = AuditCategory::withTrashed()->get();
        return view('categories.index', compact('categories'));
    }

    public function restore($id){
                  
            $category = AuditCategory::withTrashed()->findOrFail($id);
            $category->restore();
            return back()->with('success','Category Restored Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{  
            $request->validate([
                'name'=>'required|string|unique:audit_categories,name',
                'description'=> 'nulable|string'
            ]);
            DB::beginTransaction();
            
            AuditCategory::create([
                'name'=>$request->name,
                'description'=>$request->description,
            ]);

            DB::commit();
            return redirect()
            ->route('categories.index')
            ->with('success','Categories Created SUccessfully');
        }catch(\Throwable $e){
            DB::rollBack();
            Log::error('Audit Category Failed to create or store',[
                'message'=>getMessage(),
                'file'=>getFile(),
                'line'=>getLine(),
            ]);
            return back()->with('error','Something went wrong. Please try again.');
        }
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
    public function edit(AuditCategory $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, AuditCategory $category)
{
    $request->validate([
        'name' => 'required|string|unique:audit_categories,name,' . $category->id,
        'description' => 'nullable|string',
    ]);

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('categories.index')
        ->with('success', 'Category Updated Successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditCategory $category)
    {
        $category->delete();
        return back()->with('success','Category Deleted Successfully');
    }
}
