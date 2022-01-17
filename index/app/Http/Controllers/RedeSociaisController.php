<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RedeSociais;
class RedeSociaisController extends Controller
{
    public function list()
    {
        return RedeSociais::all();
    }

}
