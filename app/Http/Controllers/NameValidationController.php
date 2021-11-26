<?php

namespace App\Http\Controllers;

use App\Models\PublicPerson;
use App\Models\Query;
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

        $query = Query::create($this->validateData());

        try {

            $people = PublicPerson::getMatchingNames($name, $matchRate);

            if ($people->count() > 0) {

                $query['execution_status'] = 'Registros encontrados';
                foreach($people as $person) {
                    $query->results()->attach($person, ['match_rate' => $person->matchRate]);
                }

            } else {
                $query['execution_status'] = 'Sin coincidencias';
            }

        } catch (\Throwable $th) {
            $query['execution_status'] = 'Error del sistema';
        }

        return
    }

    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'match_rate' => 'required'
        ])
    }
}
