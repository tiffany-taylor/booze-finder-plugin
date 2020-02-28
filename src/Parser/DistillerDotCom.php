<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\Parser;

use function Room11\DOMUtils\xpath_html_class;

final class DistillerDotCom
{
    public function parse(\DOMDocument $dom)
    {
        $xpath = new \DOMXpath($dom);

        if (!$this->isBoozeFound($xpath)) {
            return null;
        }
    }

    private function isBoozeFound(\DOMXPath $xpath): bool
    {
        return (bool) $xpath->evaluate('//ol['.xpath_html_class('spirits').']/li['.xpath_html_class('spirit').']')->length;
    }

}