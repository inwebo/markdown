<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests\Token;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Token\Token;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[CoversClass(Token::class)]
#[Group('markdown')]
class TokenTest extends TestCase
{
    public function testIsBlock(): void
    {
        $token = new Token(NodeType::UL);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::UL, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::OL);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::OL, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::BLOCKQUOTE);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::BLOCKQUOTE, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::PARAGRAPH);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::PARAGRAPH, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::HR);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::HR, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H1);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H1, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H2);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H2, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H3);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H3, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H4);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H4, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H5);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H5, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::H6);
        $this->assertTrue($token->isBlock());
        $this->assertFalse($token->isInline());
        $this->assertEquals(NodeType::H6, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::BOLD);
        $this->assertFalse($token->isBlock());
        $this->assertTrue($token->isInline());
        $this->assertEquals(NodeType::BOLD, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::ITALIC);
        $this->assertFalse($token->isBlock());
        $this->assertTrue($token->isInline());
        $this->assertEquals(NodeType::ITALIC, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::STRIKETHROUGH);
        $this->assertFalse($token->isBlock());
        $this->assertTrue($token->isInline());
        $this->assertEquals(NodeType::STRIKETHROUGH, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::LINK);
        $this->assertFalse($token->isBlock());
        $this->assertTrue($token->isInline());
        $this->assertEquals(NodeType::LINK, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());

        $token = new Token(NodeType::IMAGE);
        $this->assertFalse($token->isBlock());
        $this->assertTrue($token->isInline());
        $this->assertEquals(NodeType::IMAGE, $token->getType());
        $this->assertEquals('/'.$token->getType()->value.'/im', $token->getRegex());
    }
}
