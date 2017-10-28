<?php

namespace App\Parser\Markdown;

use League\CommonMark\CommonMarkConverter;

class LeagueCommonMarkMarkdownParser implements MarkdownParser
{

    /**
     * @var CommonMarkConverter
     */
    private $converter;

    public function __construct(CommonMarkConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @inheritdoc
     */
    public function parse(string $content): string
    {
        return $this->converter->convertToHtml($content);
    }
}
