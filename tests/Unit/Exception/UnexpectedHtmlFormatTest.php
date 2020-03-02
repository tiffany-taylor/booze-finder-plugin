<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinderTest\Unit\Exception;

use AsyncBot\Plugin\BoozeFinder\Exception\UnexpectedHtmlFormat;
use PHPUnit\Framework\TestCase;


class UnexpectedHtmlFormatTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(UnexpectedHtmlFormat::class);
        $this->expectExceptionMessage('Could not find the "TEST" element in the document');

        throw new UnexpectedHtmlFormat('TEST');
    }

}