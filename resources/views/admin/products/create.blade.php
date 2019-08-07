@extends('admin.layouts.master')

@section('page')
    Add Product
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Add Product</h4>
                </div>

                <div class="content">
                    {{ Form::open(['url' => 'admin/products', 'files'=>'true']) }}   <!-- https://github.com/LaravelCollective/docs/blob/5.6/html.md -->
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.products._fields')

                                <div class="form-group">
                                    {{ Form::submit('Add Product',['class'=>'btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
