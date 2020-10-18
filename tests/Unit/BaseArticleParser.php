<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Crawlers\Configuration;
use App\Crawlers\Contracts\CrawlerClientInterface;
use App\Services\CrawlerService;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\WebTestCase;


class BaseArticleParser extends WebTestCase
{
    protected $crawler;

    public function setUp(): void
    {
        $this->crawler = $this->getMockBuilder(CrawlerClientInterface::class)
            ->onlyMethods(['getCollection', 'getTitle', 'getBody', 'getImageUrl', 'setContent'])
            ->getMock();
        $this->crawler->method('getCollection')->willReturn(['url1', 'url2', 'url3']);
        $this->crawler->method('getTitle')->willReturn('title');
        $this->crawler->method('getBody')->willReturn('body');
        $this->crawler->method('getImageUrl')->willReturn('image');

        parent::setUp();
    }

    protected function createCrawler(): CrawlerService
    {
        $mock = new MockHandler($this->getAnswers());

        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        return new CrawlerService($this->crawler, new Configuration(), $httpClient);
    }


    protected function getAnswers(): array
    {
        return [
            new Response(200, [], implode(',', ['url1', 'url2', 'url3'])),
            new Response(200, []),
            new Response(200, []),
            new Response(200, []),
        ];
    }

}
