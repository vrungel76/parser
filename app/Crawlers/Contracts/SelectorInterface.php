<?php

declare(strict_types=1);

namespace App\Crawlers\Contracts;

interface SelectorInterface
{
    public function getTitle(): string;

    public function getBody(): string;

    public function getImage(): string;

    public function getFeedBlock(): string;

    public function getHost(): string;
}
