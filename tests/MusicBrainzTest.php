<?php

namespace Chrismou\MusicBrainz\Tests;

use Chrismou\MusicBrainz\MusicBrainz;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use PHPUnit_Framework_TestCase;
use \Mockery as m;

class MusicBrainzTest extends PHPUnit_Framework_TestCase
{
    /** @var \Mockery\MockInterface */
    protected $mockClient;

    /** @var \Mockery\MockInterface */
    protected $mockPsr7Response;

    /** @var \Chrismou\MusicBrainz\MusicBrainz  */
    protected $musicbrainz;

    /** @var string */
    protected $dummyUsername;

    /** @var string */
    protected $dummyPassword;

    /**
     * Setup the test class
     */
    public function setUp()
    {
        $this->mockClient = m::mock('\GuzzleHttp\ClientInterface', [
            'request' => null,
        ]);

        $this->mockPsr7Response = m::mock('GuzzleHttp\Psr7\Response', [
            'getBody' => null,
        ]);

        $this->dummyUsername = 'chrismou';

        $this->dummyPassword = 'abc123';

        $this->musicbrainz = new MusicBrainz($this->mockClient, $this->dummyUsername, $this->dummyPassword);
    }

    /**
     * @test
     */
    public function can_instantiate_the_musicbrainz_client()
    {
        $this->assertInstanceOf('Chrismou\MusicBrainz\MusicBrainz', $this->musicbrainz);
    }
}
