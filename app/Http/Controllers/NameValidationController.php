<?php

namespace App\Http\Controllers;

use App\Models\PublicPerson;
use Illuminate\Http\Request;

class NameValidationController extends Controller
{

    /**
     * Return Public People rows when person name match rate is
     * over given expected match rate.
     *
     * @return collection
     */

    public function index()
    {
        $name = request('name');
        $matchRate = request( 'match_rate');

        return PublicPerson::getMatchingNames($name, $matchRate);
    }
}
