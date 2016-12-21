<div id="subcategory_div">
<label for="subcategory" class="control-label col-lg-2" >Subcategory</label>
    <div class="col-lg-5">
        <select id="subcategory" class="form-control m-b-10 select2" name="subcategory_id">
            @foreach ($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
            @endforeach
        </select>
    </div>
</div>