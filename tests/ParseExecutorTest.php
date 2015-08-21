<?

require_once 'BaseParserTestCase.php';

use Sector42\Pharse\ParseException;
use Sector42\Pharse\ParseExecutor;

class ParseExecutorTest extends BaseParserTestCase
{
    function testParseExecutor()
    {
        $parser = $this->getMockBuilder('\Sector42\Pharse\StringParser')
                       ->setMethods(['parse', 'setSource'])
                       ->disableOriginalConstructor()
                       ->getMock();

        $parser->expects($this->once())
               ->method('setSource');

        $parser->expects($this->once())
               ->method('parse');

        $executor = new ParseExecutor($parser);

        $expected = 'foo';

        $executor->parse($expected);

        $this->assertEquals($expected, $executor->getBuffer(), "ParseExecutor::parse() should assign it's parameter to buffer property.");
    }
}
