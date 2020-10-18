<?php

declare(strict_types=1);

namespace App\Entity;

class ArticleObject
{
    private int $id;

    private ?string $title;

    private ?string $link;

    private ?string $picture;

    private ?string $article;

    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBody(): ?string
    {
        return $this->article;
    }

    public function getShortBody(): ?string
    {
        return mb_substr($this->article, 0, 200).'...';
    }

    public function getImageUrl(): ?string
    {
        return $this->picture;
    }

    public function getArticleLink(): ?string
    {
        return $this->link;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setBody(?string $article): void
    {
        $this->article = $article;
    }

    public function setImageUrl(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function setArticleLink(?string $link): void
    {
        $this->link = $link;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    private function setData(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
