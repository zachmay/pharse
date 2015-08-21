<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\StringParser;

class StringParserTest extends BaseParserTestCase
{
    /**
     *  @expectedException Sector42\Pharse\ParseException
     *  @expectedExceptionMessage Unexpected end of input
     */
    public function testUnexpectedEndOfInput()
    {
        $executor = $this->mockExecutor('');

        $parser = new StringParser("a");
        $parser->setSource($executor);
        $parser->parse();
    }

    public function testEmptyStringParserAlwaysSucceeds()
    {
        $executor1 = $this->mockExecutor('', '');

        $parser1 = new StringParser('');
        $parser1->setSource($executor1);
        $actual = $parser1->parse();

        $this->assertEquals('', $actual, "StringParser with empty string should succeed with empty string as result.");

        $executor2 = $this->mockExecutor('abracadabra', 'abracadabra');

        $parser2 = new StringParser('');
        $parser2->setSource($executor2);
        $actual = $parser2->parse();

        $this->assertEquals('', $actual, "StringParser with empty string should succeed with empty string as result.");
    }

    /**
     * @expectedException Sector42\Pharse\ParseException
     * @expectedExceptionMessage Unexpected character 'x'
     */
    public function testUnexpectedCharacter()
    {
        $executor = $this->mockExecutor('baxf');

        $parser = new StringParser('bar');
        $parser->setSource($executor);
        $parser->parse();
    }

    public function testStateAfterParse()
    {
        $executor = $this->mockExecutor('barf', 'f');

        $parser = new StringParser('bar');
        $parser->setSource($executor);
        $parser->parse();
    }
}
