@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Create new category
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('categories') }}">Categories</a></li>
            <li class="active"> Create Category </li>
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
                    Create category
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::open(['url' => 'categories/create', 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' =>  TRUE]) !!}
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Name</label>
                                <div class="col-lg-5">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file-4" class="control-label col-lg-2">Icon</label>
                                <div class="col-lg-10">
                                    {!! Form::file('icon', ['class' => 'file']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="control-label col-lg-2">Description</label>
                                <div class="col-lg-5">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                                </div>
                            </div>
                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
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