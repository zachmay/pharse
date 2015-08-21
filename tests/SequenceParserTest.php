<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\SequenceParser;
use Sector42\Pharse\StringParser;

class SequenceParserTest extends BaseParserTestCase
{
    public function testStateAfterParse()
    {
        $expected = ['foo', 'bar', 'baz'];

        $executor = $this->mockExecutor(implode($expected, '') . 'f', 'f');

        $parser = new SequenceParser(
            new StringParser('foo'),
            new StringParser('bar'),
            new StringParser('baz')
        );
        $parser->setSource($executor);

        $actual = $parser->parse();

        $this->assertEquals($expected, $actual, 'Sequence parser should parse "foobarbaz" into ["foo", "bar", "baz"]');
    }

    /**
     * @expectedException Sector42\Pharse\ParseException
     * @expectedExceptionMessage Unexpected character 'X'
     */
    public function testSequenceFailsWhenConstituentFails()
    {
        $executor = $this->mockExecutor('foobXrbaz');

        $parser = new SequenceParser(
            new StringParser('foo'),
            new StringParser('bar'),
            new StringParser('baz')
        );

        $parser->setSource($executor);

        $parser->parse();
    }
}
