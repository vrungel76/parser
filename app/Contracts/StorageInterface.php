<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Entity\ArticleObject;
use App\Exceptions\StorageServiceException;

interface StorageInterface
{
    /**
     * @param ArticleObject[] $data
     * @throws StorageServiceException
     */
    public function save(array $data): bool;

    public function purgeData(): void;

    public function getArticleById(int $id): ArticleObject;
    /**
     * @return ArticleObject[]
     */
    public function getAllArticles(): array;
}
