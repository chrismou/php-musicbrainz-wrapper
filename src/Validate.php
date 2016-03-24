<?php

namespace Chrismou\MusicBrainz;

use Chrismou\MusicBrainz\Exception\InvalidEntityException;
use Chrismou\MusicBrainz\Exception\InvalidIncludeException;

class Validate
{
    protected static $includes = [
        'artist' => [
            'recordings',
            'releases',
            'release-groups',
            'works',
            'various-artists',
            'discids',
            'media',
            'aliases',
            'tags',
            'user-tags',
            'ratings',
            'user-ratings', // misc
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'annotation',
        ],
        'annotation' => [],
        'label' => [
            'releases',
            'discids',
            'media',
            'aliases',
            'tags',
            'user-tags',
            'ratings',
            'user-ratings', // misc
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'annotation',
        ],
        'recording' => [
            'artists',
            'releases', // sub queries
            'discids',
            'media',
            'artist-credits',
            'tags',
            'user-tags',
            'ratings',
            'user-ratings', // misc
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'annotation',
            'aliases',
        ],
        'release' => [
            'artists',
            'labels',
            'recordings',
            'release-groups',
            'media',
            'artist-credits',
            'discids',
            'puids',
            'echoprints',
            'isrcs',
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'recording-level-rels',
            'work-level-rels',
            'annotation',
            'aliases',
        ],
        'release-group' => [
            'artists',
            'releases',
            'discids',
            'media',
            'artist-credits',
            'tags',
            'user-tags',
            'ratings',
            'user-ratings', // misc
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'annotation',
            'aliases',
        ],
        'work' => [
            'artists', // sub queries
            'aliases',
            'tags',
            'user-tags',
            'ratings',
            'user-ratings', // misc
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'annotation',
        ],
        'discid'  => [
            'artists',
            'labels',
            'recordings',
            'release-groups',
            'media',
            'artist-credits',
            'discids',
            'puids',
            'echoprints',
            'isrcs',
            'artist-rels',
            'label-rels',
            'recording-rels',
            'release-rels',
            'release-group-rels',
            'url-rels',
            'work-rels',
            'recording-level-rels',
            'work-level-rels',
        ],
        'echoprint' => [
            'artists',
            'releases',
        ],
        'puid' => [
            'artists',
            'releases',
            'puids',
            'echoprints',
            'isrcs',
        ],
        'isrc' => [
            'artists',
            'releases',
            'puids',
            'echoprints',
            'isrcs',
        ],
        'iswc' => [
            'artists',
        ],
        'collection' => [
            'releases',
        ],
    ];

    public static function entity($entity)
    {
        if (!array_key_exists($entity, self::$includes)) {
            throw new InvalidEntityException(sprintf('The provided entity "%s" is not valid', $entity));
        }
    }

    public static function includes($entity, array $includes)
    {
        self::entity($entity);

        foreach ($includes as $include) {
            if (!in_array($include, self::$includes[$entity])) {
                throw new InvalidIncludeException(sprintf('The provided include "%s" is not valid', $include));
            }
        }
    }
}
