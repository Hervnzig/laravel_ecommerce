@extends('admin.layouts.master')
    @section('page')
        Edit product
    @endsection
@section('content')
<div class="row">
    <div class="col-lg-10 col-md-10">
        @include('admin.layouts.message')
        <div class="card">
            <div class="header">
                <h4 class="title">Edit Product</h4>
            </div>
            <!-- @if($errors->any())
                <ol>
                    @foreach($errors->all() as $error)
                        <li>{{  $error }}</li>
                    @endforeach
                <ol>
            @endif -->
            <div class="content">
                {!! Form::open(['url' => 'products', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.products._fields')
                        </div>

                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update Product', ['class'=>'btn btn-primary']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection