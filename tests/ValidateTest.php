<?php

namespace Chrismou\MusicBrainz\Tests;

use Chrismou\MusicBrainz\Validate;
use PHPUnit_Framework_TestCase;
use \Mockery as m;

class ValidateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Chrismou\MusicBrainz\Exception\InvalidEntityException
     */
    public function entity_check_throws_correct_exception_when_unknown_entity_is_passed()
    {
        Validate::entity('fakeEntity');
    }

    /**
     * @test
     * @expectedException \Chrismou\MusicBrainz\Exception\InvalidIncludeException
     */
    public function include_check_throws_correct_exception_when_unknown_include_is_used()
    {
        Validate::includes('artist', ['notAnInclude']);
    }

    /**
     * @test
     * @expectedException \Chrismou\MusicBrainz\Exception\InvalidEntityException
     */
    public function include_check_throws_correct_exception_when_unknown_entity_is_passed()
    {
        Validate::includes('fakeEntity', ['notAnInclude']);
    }
}
