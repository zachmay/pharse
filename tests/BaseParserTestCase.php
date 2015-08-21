<?

class BaseParserTestCase extends PHPUnit_Framework_TestCase
{
    protected function mockExecutor($before, $after = null)
    {
        $executor = $this->getMockBuilder('\Sector42\Pharse\ParseExecutor')
                         ->setMethods(['getBuffer', 'setBuffer'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $executor->expects($this->any())
                 ->method('getBuffer')
                 ->willReturn($before);

        if ( $after !== null )
        {
            $executor->expects($this->once())
                     ->method('setBuffer')
                     ->with($this->equalTo($after));
        }

        return $executor;
    }
}
