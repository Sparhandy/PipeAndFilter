<?php
namespace Sparhandy\PipeAndFilter\Tests\Unit;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Sparhandy\PipeAndFilter\PipeFactory;
use Sparhandy\PipeAndFilter\FilterInterface;

/**
 * Testcase.
 *
 * @author Philipp Witzmann <philipp.witzmann@sh.de>
 * @author Kevin Szymura <kevin.szymura@sh.de>
 */
class PipeFactoryTest extends TestCase
{
    /** @var PipeFactory */
    private $subject = null;

    /** @var MockInterface[]|FilterInterface[] */
    private $mockedFilters = [];

    /**
     * Sets up tests.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->mockedFilters = [
            Mockery::mock('Sparhandy\\PipeAndFilter\\FilterInterface'),
            Mockery::mock('Sparhandy\\PipeAndFilter\\FilterInterface'),
            Mockery::mock('Sparhandy\\PipeAndFilter\\FilterInterface'),
        ];

        $this->subject = new PipeFactory();

    }

    /**
     * @test
     */
    public function build_builds_pipes()
    {
        $result = $this->subject->build($this->mockedFilters);

        $context = [];
        $someParameter = [
            'foo' => 'bar'
        ];

        $this->mockedFilters[0]->shouldReceive('execute')->once()->with($context, $someParameter);
        $this->mockedFilters[1]->shouldReceive('execute')->once()->with($context, $someParameter);
        $this->mockedFilters[2]->shouldReceive('execute')->once()->with($context, $someParameter);

        $result->run($context, $someParameter);

        self::assertInstanceOf('Sparhandy\\PipeAndFilter\\Pipe', $result);
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1502290803
     */
    public function build_with_no_config_throwsInvalidArgumentException()
    {
        $this->subject->build([]);
    }
}