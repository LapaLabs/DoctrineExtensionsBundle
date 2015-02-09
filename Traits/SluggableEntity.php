<?php

namespace LapaLabs\DoctrineExtensionsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sluggable trait for Doctrine entities, usable with PHP >= 5.4
 *
 * @author Bocharsky Victor <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
trait SluggableEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $slug = '';

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
