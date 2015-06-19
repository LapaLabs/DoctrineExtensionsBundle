<?php

namespace LapaLabs\DoctrineExtensionsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * SEO trait for Doctrine entities, usable with PHP >= 5.4
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
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
    protected $description = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $keywords = '';

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = isset($title) ? $title : '';

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
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = isset($description) ? $description : '';

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->keywords = isset($keywords) ? $keywords : '';

        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}
