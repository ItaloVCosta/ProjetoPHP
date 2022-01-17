<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerbaIndenizatoria;
class VerbasIndenizatoriaController extends Controller
{
    public function list()
    {
        return VerbaIndenizatoria::all();
    }
}
