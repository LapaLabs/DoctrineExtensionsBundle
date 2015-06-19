<?php

namespace LapaLabs\DoctrineExtensionsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publishable trait for Doctrine entities, usable with PHP >= 5.4
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
trait PublishableEntity
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $published;

    /**
     * Is published
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * Set published to true
     *
     * @return $this
     */
    public function publish()
    {
        $this->published = true;

        return $this;
    }

    /**
     * Set published to false
     *
     * @return $this
     */
    public function unpublish()
    {
        $this->published = false;

        return $this;
    }

    /**
     * Set published
     *
     * @param bool $published
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }
}
