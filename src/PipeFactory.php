<?php
namespace Sparhandy\PipeAndFilter;

use InvalidArgumentException;

/**
 * Connects filters to each other.
 *
 * @author Philipp Witzmann <philipp.witzmann@sh.de>
 * @author Kevin Szymura <kevin.szymura@sh.de>
 * @author Alexander Christmann <alexander.christmann@sh.de>
 */
class PipeFactory
{
    /**
     * Builds pipes with the corresponding filter and connects them.
     *
     * @param FilterInterface[] $filters
     *
     * @return Pipe
     *
     * @throws InvalidArgumentException
     */
    public function build(array $filters)
    {
        if(empty($filters))
        {
            throw new InvalidArgumentException('No filters provided', 1502290803);
        }

        /** @var Pipe|null $current */
        $current = null;

        /** @var Pipe $next */
        $next = null;

        foreach ($filters as $filter)
        {
            $current = new Pipe($filter);

            if ($next !== null)
            {
                $current->setNext($next);
            }

            $next = $current;
        }

        return $current;
    }
}