<?

namespace Sector42\Pharse;

class StringParser extends Parser
{
    protected $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    protected function doParse()
    {
        if ( empty($this->string) )
        {
            return $this->string;
        }

        $ourLen = strlen($this->string);
        $theirLen = strlen($this->buffer);

        if ( $ourLen > $theirLen ) $this->fail("Unexpected end of input");

        for ( $i = 0; $i < $ourLen; $i++ )
        {
            if ( $this->string[$i] !== $this->buffer[$i] ) $this->fail("Unexpected character '{$this->buffer[$i]}'");
        }

        $this->eatBuffer($ourLen);

        return $this->string;
    }
}
