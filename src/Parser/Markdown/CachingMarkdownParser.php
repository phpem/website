<?php

namespace App\Parser\Markdown;

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class CachingMarkdownParser implements MarkdownParser
{

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var MarkdownParser
     */
    private $parser;

    public function __construct(MarkdownParser $parser, CacheInterface $cache)
    {
        $this->parser = $parser;
        $this->cache = $cache;
    }

    /**
     * @inheritdoc
     */
    public function parse(?string $content): ?string
    {
        $key = md5($content); // generate a hash for the cache key

        try {
            if ( ! $this->cache->has($key)) {
                $content = $this->parser->parse($content);
                $this->cache->set($key, $content);

                return $content;
            }

            return $this->cache->get($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }
}
