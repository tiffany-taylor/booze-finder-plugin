<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinderTest\Unit\ValueObject;


use AsyncBot\Plugin\BoozeFinder\ValueObject\Spirit;
use PHPUnit\Framework\TestCase;

class SpiritTest extends TestCase
{
    private Spirit $booze;

    protected function setUp(): void
    {
        $this->booze = new Spirit('name', 'rating');
    }

    public function testGetName(): void
    {
        $this->assertSame('name', $this->booze->getName());
    }

    public function testGetRating(): void
    {
        $this->assertSame('rating', $this->booze->getRating());
    }
}