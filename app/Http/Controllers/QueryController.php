<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueryResource;
use App\Models\Query;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function show($uuid)
    {
        $query = Query::where('uuid', $uuid)->first();
        return new QueryResource($query);
    }
}
