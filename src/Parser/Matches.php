<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Parser;

/**
 * Class Matches.
 *
 * Represents a parsed Markdown match segment.
 * A match contains the original Markdown substring, its position in the source text,
 * the parsed inner content, and optional hyperlink (`href`) or image source (`src`) attributes.
 *
 * The parser uses this class to store and retrieve information
 * about detected Markdown tokens and their contextual data.
 */
class Matches
{
    /**
     * The original Markdown substring that was matched.
     */
    private string $markdown;
    /**
     * The textual or inner content extracted from the Markdown syntax.
     */
    private string $content;
    /**
     * The hyperlink reference, if the match corresponds to a Markdown link.
     */
    private ?string $href;
    /*
     * The image source URL, if the match corresponds to a Markdown image.
     */
    private ?string $src;
    /**
     * The starting character position of the Markdown substring within the source text.
     */
    private int $markdownStartPosition;
    /**
     * The ending character position of the Markdown substring within the source text.
     */
    private int $markdownEndPosition;

    /**
     * Matches constructor.
     *
     * Initializes a new Markdown match with positional and contextual information.
     *
     * @param string      $markdown              the original Markdown substring
     * @param int         $markdownStartPosition the starting position of the match in the source
     * @param string      $content               the parsed or inner text content
     * @param string|null $href                  optional hyperlink reference (for links)
     * @param string|null $src                   optional source URL (for images)
     */
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
