<?php

namespace App\Http\Controllers;


use App\Models\Property;
use Inertia\Inertia;

class PropertyController extends Controller
{
   public function index(){
    $properties = Property::latest()->get();

    return Inertia::render('Properties/Index',[
        'properties'=>$properties
    ]);
   }
}
