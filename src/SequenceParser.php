<?

namespace Sector42\Pharse;

class SequenceParser extends Parser
{
    public $parsers;

    public function __construct()
    {
        $this->parsers = func_get_args();

        foreach ( $this->parsers as $parser )
        {
            $parser->setSource($this);
        }
    }

    protected function doParse()
    {
        $result = [];

        foreach ( $this->parsers as $parser )
        {
            $result[] = $parser->parse();
        }

        return $result;
    }
}
