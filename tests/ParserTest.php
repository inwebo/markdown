<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Model\Enum\ParserType;
use Inwebo\Markdown\Parser;
use Inwebo\Markdown\Parser\Matches;
use Inwebo\Markdown\Tests\Fixtures\Model\HasParserTrait;
use Inwebo\Markdown\Token\Token;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Parser::class)]
#[CoversClass(NodeType::class)]
#[CoversClass(Token::class)]
#[CoversClass(Matches::class)]
class ParserTest extends TestCase
{
    use HasParserTrait;

    public function testParser(): void
    {
        $parser = $this->getParser();

        $nodeCollection = $parser->parse('# H1');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H1, $node->getToken()->getType());
        $this->assertEquals('# H1', $node->getMatches()->getMarkdown());
        $this->assertEquals('H1', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(3, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('## H2');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H2, $node->getToken()->getType());
        $this->assertEquals('## H2', $node->getMatches()->getMarkdown());
        $this->assertEquals('H2', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(4, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('### H3');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H3, $node->getToken()->getType());
        $this->assertEquals('### H3', $node->getMatches()->getMarkdown());
        $this->assertEquals('H3', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(5, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('#### H4');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H4, $node->getToken()->getType());
        $this->assertEquals('#### H4', $node->getMatches()->getMarkdown());
        $this->assertEquals('H4', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(6, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('##### H5');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H5, $node->getToken()->getType());
        $this->assertEquals('##### H5', $node->getMatches()->getMarkdown());
        $this->assertEquals('H5', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(7, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('###### H6');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::H6, $node->getToken()->getType());
        $this->assertEquals('###### H6', $node->getMatches()->getMarkdown());
        $this->assertEquals('H6', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(8, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('* ol');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::OL, $node->getToken()->getType());
        $this->assertEquals('* ol', $node->getMatches()->getMarkdown());
        $this->assertEquals('ol', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(3, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('- ul');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::UL, $node->getToken()->getType());
        $this->assertEquals('- ul', $node->getMatches()->getMarkdown());
        $this->assertEquals('ul', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(3, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('Paragraph');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::PARAGRAPH, $node->getToken()->getType());
        $this->assertEquals('Paragraph', $node->getMatches()->getMarkdown());
        $this->assertEquals('Paragraph', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(8, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('---');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::HR, $node->getToken()->getType());
        $this->assertEquals('---', $node->getMatches()->getMarkdown());
        $this->assertEquals('---', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(2, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('> Blockquote');
        $node = $nodeCollection->getIterator()->current();

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::BLOCKQUOTE, $node->getToken()->getType());
        $this->assertEquals('> Blockquote', $node->getMatches()->getMarkdown());
        $this->assertEquals('Blockquote', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(11, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertFalse($node->hasParent());

        $nodeCollection = $parser->parse('**bold**');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $this->assertFalse($node->hasChildren());

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::BOLD, $node->getToken()->getType());
        $this->assertEquals('**bold**', $node->getMatches()->getMarkdown());
        $this->assertEquals('bold', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(7, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertTrue($node->hasParent());

        $nodeCollection = $parser->parse('*italic*');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $this->assertFalse($node->hasChildren());

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::ITALIC, $node->getToken()->getType());
        $this->assertEquals('*italic*', $node->getMatches()->getMarkdown());
        $this->assertEquals('italic', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(7, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertTrue($node->hasParent());

        $nodeCollection = $parser->parse('~~strikethrough~~');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $this->assertFalse($node->hasChildren());

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::STRIKETHROUGH, $node->getToken()->getType());
        $this->assertEquals('~~strikethrough~~', $node->getMatches()->getMarkdown());
        $this->assertEquals('strikethrough', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(16, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertTrue($node->hasParent());

        $nodeCollection = $parser->parse('[title](./href)');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $this->assertFalse($node->hasChildren());

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::LINK, $node->getToken()->getType());
        $this->assertEquals('[title](./href)', $node->getMatches()->getMarkdown());
        $this->assertEquals('title', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(14, $node->getMatches()->getMarkdownEndPosition());
        $this->assertTrue($node->getMatches()->isLink());
        $this->assertFalse($node->getMatches()->isImage());
        $this->assertEquals('./href', $node->getMatches()->getHref());
        $this->assertNull($node->getMatches()->getSrc());
        $this->assertTrue($node->hasParent());

        $nodeCollection = $parser->parse('![image](./href)');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $this->assertFalse($node->hasChildren());

        $this->assertCount(1, $nodeCollection);
        $this->assertEquals(NodeType::IMAGE, $node->getToken()->getType());
        $this->assertEquals('![image](./href)', $node->getMatches()->getMarkdown());
        $this->assertEquals('image', $node->getMatches()->getContent());
        $this->assertEquals(0, $node->getMatches()->getMarkdownStartPosition());
        $this->assertEquals(15, $node->getMatches()->getMarkdownEndPosition());
        $this->assertFalse($node->getMatches()->isLink());
        $this->assertTrue($node->getMatches()->isImage());
        $this->assertEquals('./href', $node->getMatches()->getSrc());
        $this->assertNull($node->getMatches()->getHref());
        $this->assertTrue($node->hasParent());
    }

    public function testGetTokens(): void
    {
        $inlines = $this->getParser()->getTokens(ParserType::INLINE);
        foreach ($inlines as $token) {
            $this->assertTrue($token->isInline());
            $this->assertFalse($token->isBlock());
        }

        $blocks = $this->getParser()->getTokens(ParserType::BLOCK);
        foreach ($blocks as $token) {
            $this->assertTrue($token->isBlock());
            $this->assertFalse($token->isInline());
        }

        $both = $this->getParser()->getTokens();
        foreach ($both as $token) {
            $this->assertTrue($token->isBlock() || $token->isInline());
        }
    }
}
