<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Parser;

class Matches
{
    private string $markdown;
    private string $content;
    private ?string $href;
    private ?string $src;
    private int $markdownStartPosition;
    private int $markdownEndPosition;

    public function __construct(string $markdown, int $markdownStartPosition, string $content, ?string $href = null, ?string $src = null)
    {
        $this->markdown = $markdown;
        $this->markdownStartPosition = $markdownStartPosition;
        $this->markdownEndPosition = $this->markdownStartPosition + strlen($this->markdown) - 1;
        $this->content = $content;
        $this->href = $href;
        $this->src = $src;
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }

    public function getMarkdownStartPosition(): int
    {
        return $this->markdownStartPosition;
    }

    public function getMarkdownEndPosition(): int
    {
        return $this->markdownEndPosition;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function isLink(): bool
    {
        return null !== $this->href;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function isImage(): bool
    {
        return null !== $this->src;
    }
}
