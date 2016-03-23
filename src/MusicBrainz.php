<?php

namespace Chrismou\MusicBrainz;

use GuzzleHttp\ClientInterface;

class MusicBrainz
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * MusicBrainz constructor.
     *
     * @param ClientInterface $httpClient
     * @param string $username
     * @param string $password
     */
    public function __construct(ClientInterface $httpClient, $username, $password)
    {
        $this->httpClient = $httpClient;
        $this->username = $username;
        $this->password = $password;
    }
}
