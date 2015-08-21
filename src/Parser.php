<?

namespace Sector42\Pharse;

abstract class Parser extends ParseConduit
{
    protected $source;

    public function setSource(ParseConduit $source)
    {
        $this->source = $source;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function fail($message)
    {
        throw new ParseException($message);
    }

    public function bufferEmpty()
    {
        return $this->buffer === "";
    }

    public function bufferRemains()
    {
        return $this->buffer !== "";
    }

    public function eatBuffer($n)
    {
        $this->buffer = substr($this->buffer, $n);
    }

    /**
     * preParse
     *
     * This method gets called immediately before performing the parser instance's actual parsing.
     */
    private function preParse()
    {
        $this->setBuffer($this->getSource()->getBuffer());
    }

    /**
     * postParse
     *
     * This method gets called immediately after performing the parser instance's actual parsing.
     */
    private function postParse()
    {
        $this->getSource()->setBuffer($this->getBuffer());

    }

    public function parse()
    {
        if ( $this->getSource() === null )
        {
            throw new \Exception("Parse source not set");
        }

        $this->preParse();

        $result = $this->doParse();

        $this->postParse();

        return $result;
    } 

    /**
     * doParse
     *
     * Parsing subclasses override this abstract method to implement their
     * specific parsing logic. The parse() function calls this, bracketed
     * by preParse() and postParse().
     */
    protected abstract function doParse();
}

