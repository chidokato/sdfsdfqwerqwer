@extends('admin.layout.main')

@section('content')
@include('admin.layout.header')
@include('admin.alert')
<?php use App\Models\CategoryTranslation; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Data list</h2>
    <a class="add-iteam"  href="{{route('dellall')}}"><button onclick="return confirm('Delete All ??? ')" class="btn-danger form-control" type="button">Delete All (50 thousand records)</button></a>

    <form action="{{ route('data.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="txt_file" accept=".txt">
        <button type="submit" class="btn-success">Upload</button>
    </form>
</div>

<div class="row">
<form class="width100" action="{{ url()->current() }}" method="GET">
    <div class="col-xl-12 col-lg-12 search flex-start">
        <input type="text" value="{{ request()->key ?? '' }}" placeholder="Bin's" class="form-control" name="key" onchange="this.form.submit()">
        <button type="submit" class="btn btn-success mr-2">Search</button>
        <a href="{{ url()->current() }}" class="btn btn-warning">
            Reset
        </a>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li><a data-toggle="tab" class="nav-link active" href="#tab1">All</a></li>
                    <!-- <li><a data-toggle="tab" class="nav-link " href="#tab2">Public</a></li> -->
                    <!-- <li><a data-toggle="tab" class="nav-link" href="#tab3">Hidden</a></li> -->
                </ul>
            </div>
            <div class="tab-content overflow">
                <div class="tab-pane active" id="tab2">
                    <div class="search">
                        <div>Hiển thị: </div>
                        <select class="form-control paginate" name="per_page" onchange="this.form.submit()">
                            <option value="100" {{ request()->per_page == 100 ? 'selected' : '' }}>100</option>
                            <option value="200" {{ request()->per_page == 200 ? 'selected' : '' }}>200</option>
                            <option value="500" {{ request()->per_page == 500 ? 'selected' : '' }}>500</option>
                            <option value="1000" {{ request()->per_page == 1000 ? 'selected' : '' }}>1000</option>
                        </select>
                        <div> Từ {{ $Datas->firstItem() }} đến {{ $Datas->lastItem() }} trên tổng {{ $Datas->total() }} </div>
                        {{ $Datas->appends(request()->all())->links() }}
                    </div>
</form>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bin</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Bank</th>
                                    <th>Countries</th>
                                    <th>date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Datas as $val)
                                <tr>
                                    <td>{{$val->id}}</td>
                                    <td>{{$val->Bin}}</td>
                                    <td>{{$val->Brand}}</td>
                                    <td>{{$val->Type}}</td>
                                    <td>{{$val->Level}}</td>
                                    <td>{{$val->Bank}}</td>
                                    <td>{{$val->Countries}}</td>
                                    <td>{{$val->created_at}}</td>
                                    <td style="display: flex;">
                                        <!-- <a href="{{route('data.edit',[$val->id])}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a> -->
                                        <form action="{{route('data.destroy', [$val->id])}}" method="POST">
                                          @method('DELETE')
                                          @csrf
                                          <button class="button_none" onclick="return confirm('You want to delete the record ?')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .table td, .table th {
        max-width: 200px;
    }
</style>

@endsection