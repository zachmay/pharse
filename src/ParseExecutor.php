<?

namespace Sector42\Pharse;

class ParseExecutor extends ParseConduit
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->parser->setSource($this);
    }

    public function parse($string)
    {
        $this->setBuffer($string);
        return $this->parser->parse();
    }
}
