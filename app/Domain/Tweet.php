<?php
/**
 * (c) Israel Martín García <israel.martin.g@gmail.com>
 * See LICENSE.txt for license details.
 */

namespace App\Domain;

class Tweet
{
    public const MEDIA_TYPE_VIDEO = 'video';

    public const MEDIA_TYPE_IMAGE = 'image';

    private $id;

    private $parentId;

    private $media;

    private $mediaType;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setParentId(string $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getMedia(): string
    {
        return $this->media;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }
}
