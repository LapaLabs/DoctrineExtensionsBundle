<?php

namespace LapaLabs\DoctrineExtensionsBundle\Form\DataTransformer;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class EntityToIdTransformer
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var EntityRepository
     */
    private $er;

    /**
     * @param EntityRepository $er
     */
    public function __construct(EntityRepository $er)
    {
        $this->er = $er;
    }

    /**
     * Transforms an entity object to an ID.
     *
     * @param  EntityToIdTransformerInterface|null $entity
     * @return string
     */
    public function transform($entity)
    {
        if (! $entity instanceof EntityToIdTransformerInterface) {
            return '';
        }

        return (string)$entity->getId();
    }

    /**
     * Transforms an entity ID to an entity object.
     *
     * @param  string $id
     *
     * @return EntityToIdTransformerInterface|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $entity = $this->er->find($id);
        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'An entity "%s" with ID "%s" does not exist!',
                $this->er->getClassName(),
                $id
            ));
        }

        return $entity;
    }
}
