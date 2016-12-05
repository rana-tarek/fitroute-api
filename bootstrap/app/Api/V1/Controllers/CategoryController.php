<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Category;
use App\Facility;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        $categories = Category::with('subcategories')->get()->toArray();
        return $this->response->array($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFacilities()
    {
        $facilities = Facility::get()->toArray();
        return $this->response->array($facilities);
    }

}
