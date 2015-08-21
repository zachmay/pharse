<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\ManyParser;
use Sector42\Pharse\StringParser;

class ManyParserTest extends BaseParserTestCase
{
    public function testEmptyStringReturnsEmptyArray()
    {
        $executor = $this->mockExecutor('', '');

        $mockParser = $this->getMockBuilder('\Sector42\Pharse\Parser')
                           ->setMethods(['doParse', 'setSource'])
                           ->disableOriginalConstructor()
                           ->getMock();

        $mockParser->expects($this->never())
                   ->method('doParse');

        $mockParser->expects($this->once())
                   ->method('setSource');

        $parser = new ManyParser($mockParser);
        $parser->setSource($executor);
        $actual = $parser->parse();

        $this->assertEquals([], $actual, 'ManyParser passed an empty string should return an empty array.');
    }

    public function testParsingExhaustsBuffer()
    {
        $executor = $this->mockExecutor('barbarbar', '');

        $stringParser = new StringParser('bar');

        $parser = new ManyParser($stringParser);
        $parser->setSource($executor);

        $actual = $parser->parse();
    }
    
    public function testStateAfterParse()
    {
        $executor = $this->mockExecutor('barbarbarf', 'f');

        $stringParser = new StringParser('bar');

        $parser = new ManyParser($stringParser);
        $parser->setSource($executor);

        $actual = $parser->parse();
    }
}
