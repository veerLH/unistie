<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\{DeptRequest};
use App\Helper\ResponseHelper;
use App\Models\{DepartCate};


class DeptCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $DepartCates = DepartCate::anyTrash($request->trash)->get();
            return DataTables::of($DepartCates)
                        ->addColumn('plus-icon', function() {
                            return null;
                        })
                        ->addColumn('action', function ($category) use ($request) {
                            $detail_btn = '';
                            $restore_btn = '';
                            $edit_btn = '<a class="edit text text-primary mr-2" href="' . route('admin.dept-cates.edit', ['dept_cate' => $category->id]) . '"><i class="far fa-edit fa-lg"></i></a>';

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
        return view('backend.admin.depar_cate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
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
