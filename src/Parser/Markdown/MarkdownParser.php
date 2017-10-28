<?php

namespace App\Parser\Markdown;

interface MarkdownParser
{
    /**
     * Renders Markdown into HTML
     *
     * @param string|string $content
     *
     * @return string|null
     */
    public function parse(?string $content): ?string;
}
