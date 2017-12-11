<?php
namespace Sparhandy\PipeAndFilter;

/**
 * Forces filters to work with passed-by-reference.
 *
 * @see https://de.wikipedia.org/wiki/Pipes_und_Filter
 *
 * @author Philipp Witzmann <philipp.witzmann@sh.de>
 * @author Kevin Szymura <kevin.szymura@sh.de>
 * @author Sebastian Knott <sebastian@sebastianknott.de>
 */
interface FilterInterface
{
    /**
     * The step to be run by pipes.
     *
     * @param mixed   $value
     * @param mixed[] $parameters
     *
     * @return mixed
     */
    public function execute(&$value, array $parameters);
}