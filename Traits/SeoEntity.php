<?php

namespace LapaLabs\DoctrineExtensionsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * SEO trait for Doctrine entities, usable with PHP >= 5.4
 *
 * @author Bocharsky Victor <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
trait SeoEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $title = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $metaDescription = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $metaKeywords = '';

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
}
