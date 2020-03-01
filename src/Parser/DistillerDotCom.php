<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\Parser;

use function Room11\DOMUtils\xpath_html_class;
use AsyncBot\Plugin\BoozeFinder\ValueObject\Booze;

final class DistillerDotCom
{
    public function parse(\DOMDocument $dom): ?Booze
    {
        $xpath = new \DOMXpath($dom);

        if (!$this->isBoozeFound($xpath)) {
            return null;
        }

        return (new Booze($this->getName($xpath), $this->getRating($xpath)));
    }

    private function isBoozeFound(\DOMXPath $xpath): bool
    {
        return (bool) $xpath->evaluate('//ol['.xpath_html_class('spirits').']/li['.xpath_html_class('spirit').']')->length;
    }

    private function getName(\DOMXpath $xpath): string
    {
        return $xpath->evaluate('//h5['.xpath_html_class('name-content').']/div['.xpath_html_class('name').']')->item(0)->textContent;
    }

    private function getRating(\DOMXPath $xpath): string
    {
        return trim($xpath->evaluate('//h3['.xpath_html_class('expert-rating').']')->item(0)->textContent);
    }

}