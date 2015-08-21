<?

namespace Sector42\Pharse;

class OptionParser extends Parser
{
    public $parsers;

    public function __construct()
    {
        $this->parsers = func_get_args();
        $this->parserCount = func_num_args();

        foreach ( $this->parsers as $parser )
        {
            $parser->setSource($this);
        }
    }

    protected function doParse()
    {
        $i = 1;
        $result = null;

        // 
        // Iterate over each parser. If one is successful,
        // its result will be returned. Otherwise, we
        // catch the ParseException and if there are no
        // more parsers to try, rethrow it.
        //

        foreach ( $this->parsers as $parser )
        {
            try
            {
                $result = $parser->parse();
            }
            catch ( ParseException $e )
            {
                // If this is the last parser we have to
                // try, re-throw the parse exception.
                if ( $i == $this->parserCount )
                {
                    throw $e;
                }
            }

            if ( $result !== null )
            {
                break;
            }
            else
            {
                $i++;
            }
        }

        return $result;
    }
}
