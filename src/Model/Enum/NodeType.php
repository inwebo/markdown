<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Enum;

enum NodeType: string
{
    case H1 = '^(?<md>#{1}(?!#)\s(?<content>.+))$';
    case H2 = '^(?<md>#{2}(?!#)\s(?<content>.+))$';
    case H3 = '^(?<md>#{3}(?!#)\s(?<content>.+))$';
    case H4 = '^(?<md>#{4}(?!#)\s(?<content>.+))$';
    case H5 = '^(?<md>#{5}(?!#)\s(?<content>.+))$';
    case H6 = '^(?<md>#{6}(?!#)\s(?<content>.+))$';
    // Blockquote: one or more consecutive lines starting with optional up to 3 spaces, '>' marker, optional space, then content
    // md = full block; content = text after the first '>' including subsequent quoted lines
    case BLOCKQUOTE = '^(?<md>(?: {0,3})>\s?(?<content>[^\r\n]+(?:\r?\n(?: {0,3})>\s?[^\r\n]+)*))$';
    // Unordered list item: use '-' (as per test fixture) with up to 3 spaces of indentation
    // Unordered list: one or more consecutive '-' items as a single block
    // @todo Le premier élément ne capture pas le - à corriger
    case UL = '^(?<md>(?: {0,3})-\s+(?<content>[^\r\n]+(?:\r?\n(?: {0,3})-\s+[^\r\n]+)*))$';
    // Ordered list (per fixture uses '*'): one or more consecutive '*' items as a single block
    case OL = '^(?<md>(?: {0,3})\*\s+(?<content>[^\r\n]+(?:\r?\n(?: {0,3})\*\s+[^\r\n]+)*))$';
    // Paragraph: one or more consecutive non-blank lines not starting with block-level markers
    // Excludes: ATX headers (#), blockquote (>), lists (-, *), fenced code, indented code, and horizontal rules (---)
    case PARAGRAPH = '^(?<md>(?!\s*$)(?!#{1,6}\s|>\s|-\s|\*\s|`{3,}| {4}|\t|-{3,}\s*$)(?<content>[^\r\n]+(?:\r?\n(?!\s*$)(?!#{1,6}\s|>\s|-\s|\*\s|`{3,}| {4}|\t|-{3,}\s*$)[^\r\n]+)*))$';
    case HR = '^(?<md>(?<content>-{3,}))$';

    case BOLD = '(?<md>\*{2}(?<content>.+?)\*{2})';
    // case ITALIC = '(?<md>(?<!\*)\*(?!\*)(?<content>.+?)(?<!\*)\*(?!\*))';
    case ITALIC = '(?<md>(?<!\*)\*(?!\s)(?!\*)(?<content>(?:[^\*]++|\*(?!\*))+?)(?<!\s)\*(?!\*))';
    case STRIKETHROUGH = '(?<md>~{2}(?<content>.+?)~{2})';
    // Markdown link: [text](url "optional title") (not image)
    // md = full markup; content = link text; href captured as named group for future use
    case LINK = '(?<md>(?<!\!)\[(?<content>[^\]]+)\]\((?<href>[^)\s]+)(?:\s+"[^"]*")?\))';
    // Markdown image: ![alt](src "optional title")
    // md = full markup; content = alt text; src captured as named group for future use
    case IMAGE = '^(?<md>!\[(?<content>[^\]]*)\]\((?<src>[^)\s]+)(?:\s+"[^"]*")?\))$';
}
