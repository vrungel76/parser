<?php

declare(strict_types=1);

namespace App\Crawlers\Contracts;

interface CrawlerClientInterface
{
    public function getTitle(string $titleSelector): string;

    public function getBody(string $bodySelector): string;

    public function getImageUrl(string $imageSelector): string;

    public function setContent(string $html): void;

    public function getCollection(string $feedSelector): array;
}
