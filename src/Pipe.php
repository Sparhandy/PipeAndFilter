<?php
namespace Sparhandy\PipeAndFilter;

/**
 * The pipe object which steps through each pipe.
 *
 * @see http://www.dossier-andreas.net/software_architecture/pipe_and_filter.html
 *
 * @author Philipp Witzmann <philipp.witzmann@sh.de>
 * @author Kevin Szymura <kevin.szymura@sh.de>
 * @author Sebastian Knott <sebastian@sebastianknott.de>
 */
class Pipe
{
    /** @var FilterInterface */
    private $filter = null;

    /** @var Pipe|null */
    private $nextPipe = null;

    /**
     * Constructor.
     *
     * @param FilterInterface $filter
     */
    public function __construct(FilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Performs the step of this pipes filter and if set, the following pipe.
     *
     * @param mixed   $value
     * @param mixed[] $parameters
     *
     * @return void
     */
    public function run(&$value, array $parameters)
    {
        $this->filter->execute($value, $parameters);

        if ($this->nextPipe instanceof self)
        {
            $this->nextPipe->run($value, $parameters);
        }
    }

    /**
     * Set the next pipe.
     *
     * @param Pipe $nextPipe
     *
     * @return void
     */
    public function setNext(Pipe $nextPipe)
    {
        $this->nextPipe = $nextPipe;
    }
}