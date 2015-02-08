<?php

namespace LapaLabs\DoctrineExtensionsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publishable trait for Doctrine entities, usable with PHP >= 5.4
 *
 * @author Bocharsky Victor <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
trait PublishableEntity
{
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $published;

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }
}
