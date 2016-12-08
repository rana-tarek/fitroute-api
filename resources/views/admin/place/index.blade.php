@extends('backend')

@section('content')
<div class="page-head">
    <h3 class="m-b-less">
        All places
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{URL::to('/')}}">Home</a></li>
            <li class="active">All Places</li>
        </ol>
    </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                @include('admin.partials.flash')
                <header class="panel-heading head-border">
                    All places
                </header>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($places as $place)
                            <tr>
                                <td>{{ $place->name }}</td>
                                <td class="hidden-xs">
                                    <a href="{{ URL::to('/places/'.$place->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ URL::to('/places/'.$place->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
@stop