<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class SiteController extends Controller
{
public function index(){


    $produtos=Produto::paginate(30);

    return view('site.home', compact('produtos'));
}
}
