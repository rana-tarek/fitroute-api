@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Edit Category
    </h3>
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('cinemas') }}">Categories</a></li>
            <li class="active"> Edit Category: {{ $category->name }} </li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Category: {{ $category->name }}
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::model($category, ['method' => 'PATCH', 'url' => 'categories/'.$category->id, 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' => TRUE]) !!}
                             <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Name</label>
                                <div class="col-lg-5">
                                    {!! Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="control-label col-lg-2">Description</label>
                                <div class="col-lg-5">
                                    {!! Form::textarea('description', $category->description, ['class' => 'form-control', 'id' => 'description']) !!}
                                </div>
                            </div>

                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">update</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<!--body wrapper end-->
@endsection
