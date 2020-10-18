<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\ArticleObject;
use App\Exceptions\StorageServiceException;
use App\Models\News;
use App\Contracts\StorageInterface;

class StorageService implements StorageInterface
{
    private News $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    function save(array $data): bool
    {
        foreach ($data as $item) {
            $model = $this->model->create($item->toArray());
            if (!$model->save()) {
                throw new StorageServiceException(
                    sprintf('Unable to save Article with URL %s', $item->getArticleLink())
                );
            }
        }
        return true;
    }

    public function purgeData(): void
    {
        $this->model->truncate();
    }

    public function getArticleById(int $id): ArticleObject
    {
        $article = $this->model->where('id', $id)->get()->first();
        return new ArticleObject($article->toArray());
    }

    /**
     * @inheritDoc
     */
    public function getAllArticles(): array
    {
        $articles = $this->model->all();
        $data =[];
        foreach ($articles as $article) {
            $data[] = new ArticleObject($article->toArray());
        }
        return $data;
    }
}

