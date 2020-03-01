<?php declare(strict_types=1);

namespace AsyncBot\Plugin\BoozeFinder;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\BoozeFinder\Retriever\SearchOnDistillerDotCom;
use AsyncBot\Plugin\BoozeFinder\ValueObject\Booze;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<Booze|null>
     */
    public function search(string $keywords): Promise
    {
        return (new SearchOnDistillerDotCom($this->httpClient))->retrieve($keywords);
    }
}
