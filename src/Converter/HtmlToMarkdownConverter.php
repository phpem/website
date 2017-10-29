<?php

namespace App\Converter;

use League\HTMLToMarkdown\HtmlConverter;

class HtmlToMarkdownConverter implements Converter
{
    /**
     * @var HtmlConverter
     */
    private $htmlConverter;

    public function __construct(HtmlConverter $htmlConverter)
    {
        $this->htmlConverter = $htmlConverter;
    }

    public function convert(?string $content): ?string
    {
        return $this->htmlConverter->convert($content);
    }

}