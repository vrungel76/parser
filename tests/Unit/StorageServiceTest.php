<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Entity\ArticleObject;
use App\Models\News;
use App\Services\StorageService;
use Tests\WebTestCase;

class StorageServiceTest extends WebTestCase
{

    private StorageService $service;

    public function setUp(): void
    {
        $this->service = new StorageService(new News);
        parent::setUp();
    }

    public function testSave()
    {
        $result = $this->service->save($this->createContent());
        $this->assertTrue($result);
    }

    public function testAllArticles()
    {
        $this->service->save($this->createContent());
        $result = $this->service->getAllArticles();

        $this->assertIsArray($result);
        $this->assertInstanceOf(ArticleObject::class, $result[0]);
    }

    public function testArticleById()
    {
        $this->service->save($this->createContent());
        $result = $this->service->getArticleById(1);

        $this->assertInstanceOf(ArticleObject::class, $result);

    }

    public function createContent()
    {
        $i = 10;
        $data = [];
        while($i > 0){
            $data[] = new ArticleObject([
                'title' => 'Test Title',
                'link' => 'http://link.to/article',
                'picture' => 'http://link.to/picture',
                'article' => 'Text',
            ]);
            $i--;
        }
        return $data;
    }
}
