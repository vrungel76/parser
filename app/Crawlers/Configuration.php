<?php

declare(strict_types=1);

namespace App\Crawlers;

use App\Crawlers\Contracts\SelectorInterface;

class Configuration implements SelectorInterface
{
    private string $host = 'https://rbc.ru';
    private string $newsBlock = 'a.js-news-feed-item';
    private string $articleTitle = '.js-slide-title';
    private string $articleBody = '.article__text';
    private string $articleImage = '.article__main-image';

    public function getTitle(): string
    {
        return $this->articleTitle;
    }

    public function getBody(): string
    {
        return $this->articleBody;
    }

    public function getImage(): string
    {
        return $this->articleImage;
    }

    public function getFeedBlock(): string
    {
        return $this->newsBlock;
    }

    public function getHost(): string
    {
        return $this->host;
    }
}
