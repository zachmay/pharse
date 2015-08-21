<?

namespace Sector42\Pharse;

class ParseConduit
{
    protected $buffer;

    public function setBuffer($string)
    {
        $this->buffer = $string;
    }

    public function getBuffer()
    {
        return $this->buffer;
    }
}
