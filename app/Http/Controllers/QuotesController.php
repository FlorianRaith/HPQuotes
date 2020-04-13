<?php

namespace App\Http\Controllers;

use App\Hpq\Difficulties;
use App\Hpq\RandomQuotesQuery;
use App\Quote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class QuotesController
 * @package App\Http\Controllers
 */
class QuotesController extends Controller
{
    /**
     * @return Quote[]|Collection
     */
    public function getAll()
    {
        $quotes = Quote::all();
        return $quotes;
    }

    /**
     * @param $language
     * @param $difficulty
     * @param $books
     * @param $amount
     * @param $seed
     * @return \Illuminate\Support\Collection
     */
    public function getRandom($language, $difficulty, $books, $amount, $seed)
    {
        $quotesQuery = new RandomQuotesQuery($language, $difficulty, $books, $amount, $seed);
        $quotes = $quotesQuery->construct()->get();
        return $quotes;
    }
}
