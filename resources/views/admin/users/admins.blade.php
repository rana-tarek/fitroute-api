@extends('backend')

@section('content')
<div class="page-head">
    <h3 class="m-b-less">
        All admins
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{URL::to('/')}}">Home</a></li>
            <li class="active">Admins</li>
        </ol>
    </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                @include('admin.partials.flash')
                <header class="panel-heading head-border">
                    All admins
                </header>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="hidden-xs">
                                    <!-- <a href="{{ URL::to('/users/'.$user->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> -->
                                    @if(Auth::user()->name != $user->name)
                                    <a href="{{ URL::to('/admins/'.$user->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                    @endif
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