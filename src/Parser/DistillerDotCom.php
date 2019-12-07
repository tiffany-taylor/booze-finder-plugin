<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\Parser;

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
        return (bool) $xpath->evaluate("//ol[@class='spirits']/li[@class='spirit']")->length;
    }
}