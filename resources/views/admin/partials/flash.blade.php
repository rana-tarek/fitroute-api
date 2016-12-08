@if (Session::has('flash_message'))
    <div class="alert alert-success alert-block fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <p>{{ Session::get('flash_message') }}</p>
    </div>
@endif