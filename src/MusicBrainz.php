<?php

namespace Chrismou\MusicBrainz;

use Chrismou\MusicBrainz\Exception\MusicBrainzErrorException;
use Chrismou\MusicBrainz\Exception\RequestErrorException;
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
     * @var string
     */
    protected $apiUrl = 'http://musicbrainz.org/ws/2/';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * MusicBrainz constructor.
     *
     * @param ClientInterface $httpClient
     * @param string $username
     * @param string $password
     * @param string $userAgent A unique identifier for your application to pass as the userAgent in the request
     *      See https://beta.musicbrainz.org/doc/XML_Web_Service/Rate_Limiting#Provide_meaningful_User-Agent_strings
     */
    public function __construct(ClientInterface $httpClient, $username, $password, $userAgent)
    {
        $this->httpClient = $httpClient;
        $this->username = $username;
        $this->password = $password;
        $this->userAgent = $userAgent;
    }

    /**
     * @param $entity
     * @param $mbid
     * @param array $includes
     *
     * @return mixed
     * @throws \Chrismou\MusicBrainz\Exception\InvalidEntityException
     * @throws \Chrismou\MusicBrainz\Exception\InvalidIncludeException
     * @throws \Chrismou\MusicBrainz\Exception\MusicBrainzErrorException
     * @throws \Chrismou\MusicBrainz\Exception\RequestErrorException
     */
    public function lookup($entity, $mbid, array $includes = [])
    {
        Validate::entity($entity);
        Validate::includes($entity, $includes);

        $uri = $entity . '/' . $mbid . '?inc=' . implode('+', $includes);

        return $this->doRequest($uri);
    }

    /**
     * @param $uri
     *
     * @return mixed
     * @throws \Chrismou\MusicBrainz\Exception\MusicBrainzErrorException
     *         Thrown when MusicBrainz returns an error from the request
     * @throws \Chrismou\MusicBrainz\Exception\RequestErrorException
     *         Thrown when a general request error is thrown - ie, network issues
     */
    protected function doRequest($uri, $method = 'GET')
    {
        try {
            $request  = $this->httpClient->request(
                $method,
                $this->buildRequestUrl($uri),
                [
                    'headers' => [
                        'User-Agent' => $this->userAgent,
                    ]
                ]
            );
            $response = $request->getBody();
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            if (json_decode($e->getResponse()->getBody())) {
                throw new MusicBrainzErrorException(json_decode($e->getResponse()->getBody())->error, $e->getCode());
            } else {
                throw new RequestErrorException($e->getResponse()->getBody(), $e->getCode());
            }
        }

        return json_decode($response);
    }

    /**
     * Builds a standard request URL from provided URI and parameters
     *
     * @param $uri
     *
     * @return string
     */
    protected function buildRequestUrl($uri)
    {
        return $this->apiUrl . $uri . '&fmt=json';
    }
}
