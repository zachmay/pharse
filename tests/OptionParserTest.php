<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\OptionParser;
use Sector42\Pharse\StringParser;

class OptionParserTest extends BaseParserTestCase
{
    public function testStateAfterParse()
    {
        $expected = 'baz';

        $executor = $this->mockExecutor("{$expected}f", 'f');

        $parser = new OptionParser(
            new StringParser('foo'),
            new StringParser('bar'),
            new StringParser('baz')
        );

        $parser->setSource($executor);

        $actual = $parser->parse();

        $this->assertEquals($expected, $actual, 'Sequence parser should parse "bazf" into "baz"');
    }

    /**
     * @expectedException Sector42\Pharse\ParseException
     * @expectedExceptionMessage Unexpected character 'X'
     */
    public function testOptionFailsWhenAllConstituentsFail()
    {
        $executor = $this->mockExecutor('bXX');

        $parser = new OptionParser(
            new StringParser('foo'),
            new StringParser('bar'),
            new StringParser('baz')
        );

        $parser->setSource($executor);

        $parser->parse();
    }
}
