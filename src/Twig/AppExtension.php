<?php

namespace App\Twig;

use App\Parser\Markdown\MarkdownParser;

class AppExtension extends \Twig_Extension
{
    /**
     * @var MarkdownParser
     */
    private $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function getFilters(): array
    {
        return [
            new \Twig_Filter(
                'markdown',
                [$this, 'renderMarkdown'],
                [
                    'is_safe' => ['html']
                ]
            ),
        ];
    }

    public function renderMarkdown(string $content): string
    {
        return $this->markdownParser->parse($content);
    }
}
