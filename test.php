<?php declare(strict_types=1);

namespace AsyncBot\Plugin\BoozeFinder;

use Amp\Http\Client\HttpClientBuilder;
use AsyncBot\Core\Http\Client;
use function Amp\Promise\wait;

require_once __DIR__ . '/vendor/autoload.php';

$plugin = new Plugin(new Client(HttpClientBuilder::buildDefault()));

var_dump(wait($plugin->search('lagavulin')));
