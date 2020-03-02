<?php declare(strict_types=1);


namespace AsyncBot\Plugin\BoozeFinderTest\Unit\Retriever;

use Amp\Http\Client\HttpClientBuilder;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\BoozeFinder\Retriever\SearchOnDistillerDotCom;
use AsyncBot\Plugin\BoozeFinder\ValueObject\Booze;
use AsyncBot\Plugin\BoozeFinderTest\Fakes\HttpClient\MockResponseInterceptor;
use PHPUnit\Framework\TestCase;
use function Amp\Promise\wait;

class SearchOnDistillerDotComTest extends TestCase
{
    public function testRetrieveReturnsBooze(): void
    {
        $httpClient = new Client(
            (new HttpClientBuilder())->intercept(
                new MockResponseInterceptor(file_get_contents(TEST_DATA_DIR . '/ResponseHtml/DistillerDotCom/valid.html')),
            )->build(),
        );

        $booze = wait((new SearchOnDistillerDotCom($httpClient))->retrieve('lagavulin'));

        $this->assertInstanceOf(Booze::class, $booze);
    }

}