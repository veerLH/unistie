@extends('backend.admin.layouts.app')

@section('meta_title', 'Edit academic categoty')
@section('page_title', 'Edit academic categoty')
@section('page_title_icon')
<i class="metismenu-icon pe-7s-users"></i>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form action="{{ route('admin.academic-cates.update', ['academic_cate' => $academic_cate->id]) }}" method="post" id="form">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$academic_cate->name}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                            <input type="number" name="rank" id="rank" class="form-control" value="{{$academic_cate->rank}}">
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('admin.academic-cates.index') }}" class="btn btn-danger mr-5">Cancel</a>
                            <input type="submit" value="Update" class="btn btn-success">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\StoreAcademic', '#form') !!}
@endsection