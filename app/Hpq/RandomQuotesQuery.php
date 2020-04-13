<?php


namespace App\Hpq;


use App\Quote;
use Illuminate\Database\Eloquent\Builder;

class RandomQuotesQuery
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $difficulty;

    /**
     * @var string
     */
    private $books;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $seed;

    /**
     * RandomQuotesQuery constructor.
     * @param string $language
     * @param string $difficulty
     * @param string $books
     * @param string $amount
     * @param string $seed
     */
    public function __construct(string $language, string $difficulty, string $books, string $amount, string $seed)
    {
        $this->language = $language;
        $this->difficulty = $difficulty;
        $this->books = $books;
        $this->amount = $amount;
        $this->seed = $seed;
    }

    /**
     * @return Builder
     */
    public function construct(): Builder
    {
        $allBooks = false;
        $booksArr = [];
        foreach (str_split($this->books) as $book) {
            if($book == '0') {
                $allBooks = true;
                break;
            }
            if(is_numeric($book)) {
                $booksArr[] = $book;
            }
        }

        $difficulties = Difficulties::fromString($this->difficulty);

        $seedValue = '';

        foreach(str_split($this->seed) as $char) {
            $seedValue .= ord($char);
        }

        $quotesQuery = Quote::where('language', $this->language)->whereIn('difficulty', $difficulties->asArray());
        if(!$allBooks) $quotesQuery = $quotesQuery->whereIn('book', $booksArr);
        $quotesQuery = $quotesQuery->inRandomOrder($seedValue)->limit($this->amount);

        return $quotesQuery;
    }
}