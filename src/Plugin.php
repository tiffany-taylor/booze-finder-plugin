<?php declare(strict_types=1);

namespace AsyncBot\Plugin\BoozeFinder;

use Amp\Promise;
use AsyncBot\Core\Http\Client;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $keywords): Promise
    {

    }
}
