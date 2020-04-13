<?php


namespace App\Hpq;


class Difficulties
{
    /**
     * @var bool
     */
    private $easy;

    /**
     * @var bool
     */
    private $medium;

    /**
     * @var bool
     */
    private $hard;

    /**
     * Difficulties constructor.
     * @param bool $easy
     * @param bool $medium
     * @param bool $hard
     */
    public function __construct(bool $easy, bool $medium, bool $hard)
    {
        $this->easy = $easy;
        $this->medium = $medium;
        $this->hard = $hard;
    }

    /**
     * @param string $input
     * @return Difficulties
     */
    public static function fromString(string $input): Difficulties
    {
        $easy = false;
        $medium = false;
        $hard = false;
        foreach (str_split($input) as $difficulty) {
            if($difficulty =='e') {
                $easy = true;
            } else if($difficulty == 'm') {
                $medium = true;
            } else if($difficulty == 'h') {
                $hard = true;
            }
        }

        return new Difficulties($easy, $medium, $hard);
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $arr = [];
        if($this->easy) $arr[] = 1;
        if($this->medium) $arr[] = 2;
        if($this->hard) $arr[] = 3;
        return $arr;
     }
}