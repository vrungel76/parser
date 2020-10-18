<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\ArticleObject;
use App\Exceptions\CrawlerServiceException;

class ArticleParseService
{
    private CrawlerService $crawlerService;

    public function __construct(CrawlerService $crawlerService)
    {
        $this->crawlerService = $crawlerService;
    }

    /**
     * @return ArticleObject[]
     * @throws CrawlerServiceException
     */
    public function parse(): array
    {
        $urlCollection = $this->crawlerService->getArticleCollection();
        $data = [];
        foreach ($urlCollection as $url) {
            $this->crawlerService->setContent($url);
            if ($this->crawlerService->getTitle() === '') {
                continue;
            }
            $dto = new ArticleObject();
            $dto->setArticleLink($url);
            $dto->setTitle($this->crawlerService->getTitle());
            $dto->setBody($this->crawlerService->getBody());
            $dto->setImageUrl($this->crawlerService->getImageUrl());
            $data[] = $dto;
        }
        return $data;
    }
}
