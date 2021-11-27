<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Http\Resources\QueryResource;
use App\Models\PublicPerson;
use App\Models\Query;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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
        $name = request('searched_name');
        $matchRate = request( 'match_rate');

        $uuid = Uuid::uuid4();
        $queryData = $this->validateData();
        $queryData['uuid'] = $uuid->toString();;

        $query = Query::create($queryData);

        try {

            $people = PublicPerson::getMatchingNames($name, $matchRate);

            if ($people->count() > 0) {

                $query['execution_status'] = 'Registros encontrados';

                foreach($people as $person) {
                    $query->results()->attach($person, ['match_rate' => $person->matchRate ]);
                }

            }

        } catch (\Throwable $th) {
            $query['execution_status'] = 'Error del sistema';
        }

        return new QueryResource($query);
    }

    private function validateData()
    {
        return request()->validate([
            'searched_name' => 'required|string',
            'match_rate' => 'required'
        ]);
    }
}
