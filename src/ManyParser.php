<?

namespace Sector42\Pharse;

class ManyParser extends Parser
{
    public $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->parser->setSource($this);
    }

    protected function doParse()
    {
        $result = [];

        try
        {
            while ( $this->bufferRemains() )
            {
                $result[] = $this->parser->parse(); 
            }
        }
        catch ( ParseException $e )
        {
            // Ignore.
        }

        return $result;
    }
}
