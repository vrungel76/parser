<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Entity\ArticleObject;
use App\Services\ArticleParseService;

class ArticleParserServiceTest extends BaseArticleParser
{

    public function testParse()
    {
        $service = new ArticleParseService($this->createCrawler());

        $result = $service->parse();

        $this->assertIsArray($result);
        $this->assertInstanceOf(ArticleObject::class, $result[0]);
    }
}
