<?php

declare(strict_types=1);

namespace App\Services;

use App\Crawlers\Contracts\CrawlerClientInterface;
use App\Crawlers\Contracts\SelectorInterface;
use App\Exceptions\CrawlerServiceException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class CrawlerService
{
    private CrawlerClientInterface $crawlerClient;

    private SelectorInterface $selector;

    private HttpClient $httpClient;

    public function __construct(
        CrawlerClientInterface $crawlerClient,
        SelectorInterface $selector,
        HttpClient $httpClient
    )
    {
        $this->crawlerClient = $crawlerClient;
        $this->selector = $selector;
        $this->httpClient = $httpClient;
    }

    public function getTitle(): string
    {
        return $this->crawlerClient->getTitle($this->selector->getTitle());
    }

    public function getBody(): string
    {
        return $this->crawlerClient->getBody($this->selector->getBody());
    }

    public function getImageUrl(): string
    {
        return $this->crawlerClient->getImageUrl($this->selector->getImage());
    }

    /**
     * @return string[]
     * @throws CrawlerServiceException
     */
    public function getArticleCollection(): array
    {
        $this->setContent($this->selector->getHost());
        return $this->crawlerClient->getCollection($this->selector->getFeedBlock());
    }

    /**
     * @throws CrawlerServiceException
     */
    public function setContent(string $url): void
    {
        try {
            $html = $this->httpClient->request('GET', $url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new CrawlerServiceException(
                sprintf('Wrong response %s while requested url %s', $e->getMessage(), $url)
            );
        }
        $this->crawlerClient->setContent($html);
    }


}
