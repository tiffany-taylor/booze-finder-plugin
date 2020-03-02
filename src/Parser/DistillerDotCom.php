<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\Parser;

use function Room11\DOMUtils\xpath_html_class;
use AsyncBot\Plugin\BoozeFinder\Exception\UnexpectedHtmlFormat;
use AsyncBot\Plugin\BoozeFinder\ValueObject\Booze;

final class DistillerDotCom
{
    public function parse(\DOMDocument $dom): ?Booze
    {
        $xpath = new \DOMXpath($dom);

        if (!$this->isBoozeFound($xpath)) {
            return null;
        }

        return (new Booze($this->parseName($xpath), $this->parseRating($xpath)));
    }

    private function isBoozeFound(\DOMXPath $xpath): bool
    {
        return (bool) $xpath->evaluate('//ol['.xpath_html_class('spirits').']/li['.xpath_html_class('spirit').']')->length;
    }

    private function parseName(\DOMXpath $xpath): string
    {
        /** @var \DOMNodeList $nameNodes */
        $nameNodes = $xpath->evaluate('//h5['.xpath_html_class('name-content').']/div['.xpath_html_class('name').']');

        if (!$nameNodes->length) {
            throw new UnexpectedHtmlFormat('name');
        }

        return $nameNodes->item(0)->textContent;
    }

    private function parseRating(\DOMXPath $xpath): string
    {
        /** @var \DOMNodeList $ratingNodes */
        $ratingNodes = $xpath->evaluate('//h3['.xpath_html_class('expert-rating').']');

        if (!$ratingNodes->length) {
            throw new UnexpectedHtmlFormat('rating');
        }

        return trim($ratingNodes->item(0)->textContent);
    }

}