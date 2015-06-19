<?php

namespace LapaLabs\DoctrineExtensionsBundle\Form\DataTransformer;

/**
 * Interface EntityToIdTransformerInterface
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
interface EntityToIdTransformerInterface
{
    /**
     * @return mixed
     */
    public function getId();
}
