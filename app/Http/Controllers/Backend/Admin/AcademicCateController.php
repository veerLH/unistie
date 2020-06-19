<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\{StoreAcademic};
use App\Helper\ResponseHelper;
use App\Models\{AcCategory};

class AcademicCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $AcCategories = AcCategory::anyTrash($request->trash)->get();
            return DataTables::of($AcCategories)
                        ->addColumn('plus-icon', function() {
                            return null;
                        })
                        ->addColumn('action', function ($category) use ($request) {
                            $detail_btn = '';
                            $restore_btn = '';
                            $edit_btn = '<a class="edit text text-primary mr-2" href="' . route('admin.academic-cates.edit', ['academic_cate' => $category->id]) . '"><i class="far fa-edit fa-lg"></i></a>';

                            if ($request->trash == 1) {
                                $restore_btn = '<a class="restore text text-warning mr-2" href="#" data-id="' . $category->id . '"><i class="fa fa-trash-restore fa-lg"></i></a>';
                                $trash_or_delete_btn = '<a class="destroy text text-danger mr-2" href="#" data-id="' . $category->id . '"><i class="fa fa-minus-circle fa-lg"></i></a>';
                            } else {
                                $trash_or_delete_btn = '<a class="trash text text-danger mr-2" href="#" data-id="' . $category->id . '"><i class="fas fa-trash fa-lg"></i></a>';
                            }

                            return "${detail_btn} ${edit_btn} ${restore_btn} ${trash_or_delete_btn}";
                        })
                        ->rawColumns(['plus-icon','action'])
                        ->make(true);
        }
        return view('backend.admin.academic_cate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_categories = AcCategory::noTrash();
        $suggest_rank = $active_categories->max('rank') + 1;
        return view('backend.admin.academic_cate.create', compact('suggest_rank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademic $request)
    {
        $check_slug = AcCategory::where('slug', $request->name)->first();
        if($check_slug) {
            return back()->withErrors(['msg' => 'Link is already exist.'])->withInput();
        }
        $slug = Str::slug($request->name);
        $request['slug'] = $slug;
        AcCategory::create($request->all());

        return redirect()->route('admin.academic_cates.index')->with('success', 'New academic_cate Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AcCategory $academic_cate)
    {
        //
        return view('backend.admin.academic_cate.edit',compact('academic_cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAcademic $request, AcCategory $academic_cate)
    {
        $check_slug = AcCategory::where('slug', $request->name)->first();
        if($check_slug) {
            return back()->withErrors(['msg' => 'Link is already exist.'])->withInput();
        }
        $slug = Str::slug($request->name);
        $request['slug'] = $slug;
        $academic_cate->update($request->all());

        return redirect()->route('admin.academic-cates.index')->with('success', 'New academic_cate Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
