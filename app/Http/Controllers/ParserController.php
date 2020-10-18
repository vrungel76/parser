<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ParserException;
use App\Services\ArticleParseService;
use App\Contracts\StorageInterface;
use Illuminate\Http\RedirectResponse;

class ParserController extends Controller
{

    private ArticleParseService $parserService;

    private StorageInterface $storage;

    public function __construct(ArticleParseService $parserService, StorageInterface $storage)
    {
        $this->parserService = $parserService;
        $this->storage = $storage;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('list', [
            'data' => $this->storage->getAllArticles()
        ]);
    }

    /**
     * @throws ParserException
     */
    public function parse(): RedirectResponse
    {
        $this->storage->purgeData();
        $this->storage->save($this->parserService->parse());

        return redirect()->route('home');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fullArticle(int $id)
    {
        return view('full', [
            'article' => $this->storage->getArticleById($id)
        ]);
    }
}
