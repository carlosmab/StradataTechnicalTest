<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicPerson extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Return Public People rows when person name match rate is
     * over given expected match rate.
     *
     * @return collection
     */
    public static function getMatchingNames($name, $expectedMatchRate)
    {
        $matchingPeople = collect();

        foreach(PublicPerson::all() as $person) {

            $name = PublicPerson::cleanName($name);
            $personName = PublicPerson::cleanName($person->name);

            // dd($name, $personName);

            similar_text($name, $personName, $matchRate);

            if ($matchRate >= $expectedMatchRate) {
                $person['matchRate'] = $matchRate;
                $matchingPeople->add($person);
            }
        }

        return $matchingPeople;
    }

    /**
     * Clean name string
     *  Case insensitive
     *  No special characters
     *  No PHonetic differences
     *
     * @return string
     */

    public static function cleanName($name)
    {
        // To Uppercase
        $name = strtoupper($name);

        // Remove special characters
        $name = preg_replace('([^A-Za-z0-9 ])', '', $name);

        // Phonetic matches in Spanish
        $name = str_replace("S", "Z", $name);
        $name = str_replace("CI", "ZI", $name);
        $name = str_replace("CE", "ZE", $name);
        $name = str_replace("CC", "CZ", $name);
        $name = str_replace("X", "CZ", $name);
        $name = str_replace("V", "B", $name);
        $name = str_replace("LL", "Y", $name);
        $name = str_replace("K", "C", $name);
        $name = str_replace("H", "", $name);
        $name = str_replace("GE", "JE", $name);
        $name = str_replace("GI", "JI", $name);

        return $name;
    }
}
