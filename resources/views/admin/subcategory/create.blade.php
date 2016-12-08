@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Create new subcategory
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('cinemas') }}">Subcategories</a></li>
            <li class="active"> Create Subcategories </li>
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
                    Create subcategory
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::open(['url' => 'subcategories/create', 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' =>  TRUE]) !!}
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Name</label>
                                <div class="col-lg-5">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="control-label col-lg-2">Category</label>
                                <div class="col-lg-5">
                                    <select id="category" class="form-control m-b-10 select2" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-4 control-label">Facilities</label>
                                <div class="col-lg-9 col-md-8">
                                    <div class="input-group select2-bootstrap-append">
                                        <select id="single-append-text" class="form-control select2-allow-clear" name="facilities[]" multiple>
                                            @foreach ($facilities as $facility)
                                                <option value="{{$facility->id}}">{{$facility->name}}</option>
                                            @endforeach
                                        </select>
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                          <span class="glyphicon glyphicon-search"></span>
                                      </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Save</button>
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
@section('scripts')
<script type="text/javascript">

        $('#category').select2({
            placeholder: 'Please select a category'
        });

</script>
@endsection
