<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\ValueObject;


final class Booze
{
    private string $name;
    private string $rating;

    public function __construct(string $name, string $rating)
    {
        $this->name = $name;
        $this->rating = $rating;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

}