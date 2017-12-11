<?php
namespace Sparhandy\PipeAndFilter\Tests\Unit;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Sparhandy\PipeAndFilter\FilterInterface;
use Sparhandy\PipeAndFilter\Pipe;

/**
 * Testcase.
 *
 * @author Philipp Witzmann <philipp.witzmann@sh.de>
 * @author Kevin Szymura <kevin.szymura@sh.de>
 * @author Sebastian Knott <sebastian@sebastianknott.de>
 */
class PipeTest extends TestCase
{
    /** @var MockInterface|FilterInterface */
    private $mockedFilter = null;

    /** @var MockInterface|Pipe */
    private $mockedPipe = null;

    /** @var Pipe */
    private $subject = null;

    protected function setUp()
    {
        $this->mockedFilter = Mockery::mock('Sparhandy\\PipeAndFilter\\FilterInterface');
        $this->mockedPipe   = Mockery::mock('Sparhandy\\PipeAndFilter\\Pipe');

        $this->subject = new Pipe($this->mockedFilter);
    }

    /**
     * @test
     */
    public function pipe_executes_given_filter_and_next_pipe()
    {
        $this->subject->setNext($this->mockedPipe);

        $mockedValue      = 'foo';
        $mockedParameters = ['bar' => 'baz'];

        $this->mockedFilter->shouldReceive('execute')->once()->with($mockedValue, $mockedParameters)->andReturn();
        $this->mockedPipe->shouldReceive('run')->once()->with($mockedValue, $mockedParameters)->andReturn();

        $this->subject->run($mockedValue, $mockedParameters);
    }

    /**
     * @test
     */
    public function pipe_executes_given_filter_and_no_next_pipe()
    {
        $mockedValue      = 'foo';
        $mockedParameters = ['bar' => 'baz'];

        $this->mockedFilter->shouldReceive('execute')->once()->with($mockedValue, $mockedParameters)->andReturn();

        $this->subject->run($mockedValue, $mockedParameters);
    }
}