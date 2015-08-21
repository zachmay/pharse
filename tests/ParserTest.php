<?

require_once('BaseParserTestCase.php');

use Sector42\Pharse\ParseException;
use Sector42\Pharse\Parser;

class DumbParser extends Parser
{
    protected function doParse()
    {
        return null;
    }
}

class ParserTest extends BaseParserTestCase
{
    public function testBufferEmpty()
    {
        $executorEmpty = $this->mockExecutor('');
        $executorFull  = $this->mockExecutor('not empty');

        $preParseMethod = new ReflectionMethod('DumbParser', 'preParse');
        $preParseMethod->setAccessible(true);

        $parser = new DumbParser('whatever');
        $parser->setSource($executorEmpty);
        $preParseMethod->invoke($parser);
        $this->assertTrue($parser->bufferEmpty(), 'bufferEmpty() should return true if buffer is empty string.');

        $parser = new DumbParser('whatever');
        $parser->setSource($executorFull);
        $preParseMethod->invoke($parser);
        $this->assertFalse($parser->bufferEmpty(), 'bufferEmpty() should return false if buffer is non-empty string.');
    }

    public function testBufferRemains()
    {
        $executorEmpty = $this->mockExecutor('');
        $executorFull  = $this->mockExecutor('not empty');

        $preParseMethod = new ReflectionMethod('DumbParser', 'preParse');
        $preParseMethod->setAccessible(true);

        $parser = new DumbParser('whatever');
        $parser->setSource($executorEmpty);
        $preParseMethod->invoke($parser);
        $this->assertFalse($parser->bufferRemains(), 'bufferRemains() should return false if buffer is empty string.');

        $parser = new DumbParser('whatever');
        $parser->setSource($executorFull);
        $preParseMethod->invoke($parser);
        $this->assertTrue($parser->bufferRemains(), 'bufferRemains() should return true if buffer is non-empty string.');
    }

    /**
     * @expectedException \Exception
     */
    public function testParseWithoutSourceThrowsException()
    {
        $parser = new DumbParser();
        $parser->parse();
    }
}
