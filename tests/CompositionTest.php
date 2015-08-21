<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\StringParser;
use Sector42\Pharse\SequenceParser;

class CompositionTest extends BaseParserTestCase
{
    public function testSExpressionParser()
    {
        $executor = $this->mockExecutor('(()(()()(()))((())))()(()()())');

        $parser = new SequenceParser(
            new StringParser('('),
            $parser,
            new StringParser(')')
        );

        $parser->setSource($executor);
        $result = $parser->parse();
    }
}
