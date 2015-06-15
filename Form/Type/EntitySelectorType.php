<?php

namespace LapaLabs\DoctrineExtensionsBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use LapaLabs\DoctrineExtensionsBundle\Form\DataTransformer\EntityToIdTransformer;

/**
 * Class EntitySelectorType
 */
abstract class EntitySelectorType extends AbstractType
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
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new EntityToIdTransformer($this->er));
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected entity does not exist',
        ));
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'entity_selector';
    }
}
