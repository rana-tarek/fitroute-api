@if (count($errors) > 0)
<div class="alert alert-danger alert-block fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <h4>
        <i class="fa fa-ok-sign"></i>
        Error!
    </h4>
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif