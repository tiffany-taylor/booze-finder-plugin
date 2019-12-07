<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinder\Retriever;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\BoozeFinder\Parser\DistillerDotCom;
use function Amp\call;

final class SearchOnDistillerDotCom
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function retrieve(string $command): Promise
    {
        return call(function () use ($command) {
            $dom = yield $this->httpClient->requestHtml(
                sprintf('https://distiller.com/search?term=%s', urlencode($command)),
            );

            return (new DistillerDotCom())->parse($dom);
        });
    }
}