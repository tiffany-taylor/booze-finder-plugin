<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinderTest\Unit\ValueObject;


use AsyncBot\Plugin\BoozeFinder\ValueObject\Booze;
use PHPUnit\Framework\TestCase;

class BoozeTest extends TestCase
{
    private Booze $booze;

    protected function setUp(): void
    {
        $this->booze = new Booze('name', 'rating');
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