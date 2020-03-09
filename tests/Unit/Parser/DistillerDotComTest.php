<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinderTest\Unit\Parser;

use AsyncBot\Plugin\BoozeFinder\Exception\UnexpectedHtmlFormat;
use AsyncBot\Plugin\BoozeFinder\Parser\DistillerDotCom;
use AsyncBot\Plugin\BoozeFinder\ValueObject\Spirit;
use PHPUnit\Framework\TestCase;
use function Room11\DOMUtils\domdocument_load_html;

class DistillerDotComTest extends TestCase
{
    private function getDomFromFakeResponse(string $filename): \DOMDocument
    {
        return domdocument_load_html(
            file_get_contents(TEST_DATA_DIR . '/ResponseHtml/DistillerDotCom/' . $filename),
        );
    }

    public function testParseReturnsNullWhenCommandCouldNotBeFound(): void
    {
        $this->assertNull((new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('command-not-found.html')
        ));
    }

    public function testParseReturnsBoozeWhenValid(): void
    {
        $booze = (new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('valid.html'),
        );

        $this->assertInstanceOf(Spirit::class, $booze);
    }

    public function testParseReturnsCorrectName(): void
    {
        $booze = (new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('valid.html'),
        );

        $this->assertSame('Lagavulin 16 Year', $booze->getName());
    }

    public function testParseReturnsCorrectRating(): void
    {
        $booze = (new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('valid.html'),
        );

        $this->assertSame('92', $booze->getRating());
    }

    public function testParseThrowsOnMissingNameElement(): void
    {
        $this->expectException(UnexpectedHtmlFormat::class);
        $this->expectExceptionMessage('Could not find the "name" element in the document');

        (new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('missing-name-element.html'),
        );
    }

    public function testParseThrowsOnMissingRating(): void
    {
        $this->expectException(UnexpectedHtmlFormat::class);
        $this->expectExceptionMessage('Could not find the "rating" element in the document');

        (new DistillerDotCom())->parse(
            $this->getDomFromFakeResponse('missing-rating-element.html'),
        );
    }
}