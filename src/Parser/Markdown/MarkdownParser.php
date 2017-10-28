<?php

namespace App\Parser\Markdown;

interface MarkdownParser
{
    /**
     * Renders Markdown into HTML
     *
     * @param string $content
     *
     * @return string
     */
    public function parse(string $content): string;
}
