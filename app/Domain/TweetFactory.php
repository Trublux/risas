<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Domain;

use Exception;
use TypeError;

class TweetFactory
{
    public function create(array $data): ?Tweet
    {
        $media = null;
        $mediaType = null;
        if (isset($data['quoted_status']['extended_entities']['media'][0]['video_info']['variants'][0]['url'])) {
            $media = $this->getValidVideoFormat($data['quoted_status']['extended_entities']['media'][0]['video_info']['variants']);
            $mediaType = Tweet::MEDIA_TYPE_VIDEO;
        } elseif (isset($data['quoted_status']['entities']['media'][0]['media_url_https'])) {
            $media = $data['quoted_status']['entities']['media'][0]['media_url_https'];
            $mediaType = Tweet::MEDIA_TYPE_IMAGE;
        }

        try {
            $tweet = (new Tweet())
                ->setId($data['quoted_status_id_str'])
                ->setParentId($data['quoted_status_id_str'])
                ->setMedia($media)
                ->setMediaType($mediaType)
            ;
        } catch (Exception | TypeError $exception) {
            $tweet = null;
        }

        return $tweet;
    }

    private function getValidVideoFormat(array $variants): ?string
    {
        foreach ($variants as $video) {
            if ('video/mp4' === $video['content_type']) {
                return $video['url'];
            }
        }

        return null;
    }
}
