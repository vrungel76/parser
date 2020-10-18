<?php

declare(strict_types=1);

namespace App\Crawlers\Clients;

use App\Crawlers\Contracts\CrawlerClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerClient implements CrawlerClientInterface
{
    private Crawler $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function getTitle(string $titleSelector): string
    {
        return $this->getFirst($titleSelector);
    }

    public function getBody(string $bodySelector): string
    {
        return $this->getFirst($bodySelector);
    }

    public function getImageUrl(string $imageSelector): string
    {
        $dom = $this->crawler->filter($imageSelector);
        return $dom->count() > 0 ? $dom->filter('img')->attr('src') : '';
    }

    public function setContent(string $html): void
    {
        $this->crawler->clear();
        $this->crawler->add($html);
    }

    /**
     * @return string[]
     */
    public function getCollection(string $feedSelector): array
    {
        return $this->crawler->filter($feedSelector)->extract(['href']);
    }

    private function getFirst(string $selector): string
    {
        $dom = $this->crawler->filter($selector)->first();
        return $dom->count() > 0 ? $dom->text() : '';
    }
}
