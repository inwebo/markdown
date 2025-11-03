<?php

declare(strict_types=1);

namespace Inwebo\Markdown;

use Inwebo\Markdown\Model\Enum;
use Inwebo\Markdown\Node\Node;
use Inwebo\Markdown\Node\NodeCollection;
use Inwebo\Markdown\Parser\Matches;
use Inwebo\Markdown\Token\Token;

/**
 * Class Parser.
 *
 * The Parser class is responsible for converting Markdown source text
 * (or existing Node structures) into a tree of Node objects.
 * It uses a collection of Token definitions to identify Markdown patterns
 * and produce Nodes representing inline and block-level elements.
 *
 * This class acts as the core parsing engine in the Markdown library.
 */
class Parser
{
    /**
     * @var \ArrayObject<int, Token>
     */
    private \ArrayObject $tokens;

    /**
     * Initializes the parser with one or more Token definitions.
     * Each Token provides a regular expression pattern used to
     * match specific Markdown syntax constructs.
     */
    public function __construct(Token ...$tokens)
    {
        $this->tokens = new \ArrayObject(array_values($tokens));
    }

    /**
     * @return array<int, Token>
     */
    public function getTokens(Enum\ParserType $type = Enum\ParserType::BOTH): array
    {
        switch ($type) {
            case Enum\ParserType::BOTH:
                return $this->tokens->getArrayCopy();
            case Enum\ParserType::INLINE:
                return array_values(array_filter($this->tokens->getArrayCopy(), fn (Token $token) => $token->isInline()));
            case Enum\ParserType::BLOCK:
                return array_values(array_filter($this->tokens->getArrayCopy(), fn (Token $token) => $token->isBlock()));
        }
    }

    /**
     * Parses the given input (string or Node) into a collection of Node objects.
     *
     * When given a string, the parser processes it as a block-level Markdown input.
     * When given a Node, it treats it as inline Markdown content and attaches child nodes.
     *
     * The parser iterates through all registered Tokens, performs regular expression
     * matching, and creates Node objects representing each detected Markdown structure.*
     *
     * @return NodeCollection<int, Node>
     */
    public function parse(Node|string $input): NodeCollection
    {
        $tokenType = is_string($input) ? Enum\ParserType::BLOCK : Enum\ParserType::INLINE;
        $subject = is_string($input) ? $input : $input->getMatches()->getContent();
        $nodes = new NodeCollection();

        foreach ($this->getTokens($tokenType) as $token) {
            $results = preg_match_all($token->getRegex(), $subject, $matches, \PREG_OFFSET_CAPTURE);

            if (false !== $results && $results > 0 && !empty($matches)) {
                $length = count($matches['md']);
                for ($i = 0; $i < $length; ++$i) {
                    $md = $matches['md'][$i][0];
                    $startPosition = (int) $matches['md'][$i][1];
                    $content = $matches['content'][$i][0];
                    $href = $matches['href'][$i][0] ?? null;
                    $src = $matches['src'][$i][0] ?? null;

                    $normalisedMatches = new Matches($md, $startPosition, $content, $href, $src);
                    $newNode = new Node($normalisedMatches, $token);

                    if ($input instanceof Node) {
                        $newNode->setParent($input);
                    }
                    $nodes->addNode($newNode);
                }
            }
        }

        return $nodes;
    }
}
