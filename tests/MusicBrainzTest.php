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

    /** @var string */
    protected $dummyUserAgent;

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

        $this->dummyUserAgent = 'chrismou-musicbrainz-test\1.0';

        $this->musicbrainz = new MusicBrainz(
            $this->mockClient,
            $this->dummyUsername,
            $this->dummyPassword,
            $this->dummyUserAgent
        );
    }

    /**
     * @test
     */
    public function can_instantiate_the_musicbrainz_client()
    {
        $this->assertInstanceOf('Chrismou\MusicBrainz\MusicBrainz', $this->musicbrainz);
    }

    /**
     * @test
     * @expectedException \Chrismou\MusicBrainz\Exception\InvalidEntityException
     */
    public function it_throws_exception_when_unknown_entity_is_used()
    {
        $this->musicbrainz->lookup('fakeEntity', '123', []);
    }

    /**
     * @test
     * @expectedException \Chrismou\MusicBrainz\Exception\InvalidIncludeException
     */
    public function it_throws_exception_when_unknown_include_is_used()
    {
        $this->musicbrainz->lookup('artist', '123', ['notAnInclude']);
    }
}
