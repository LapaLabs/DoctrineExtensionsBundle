<?php

namespace LapaLabs\DoctrineExtensionsBundle\Form\DataTransformer;

/**
 * Interface EntityToIdTransformerInterface
 */
interface EntityToIdTransformerInterface
{
    /**
     * @return mixed
     */
    public function getId();
}
