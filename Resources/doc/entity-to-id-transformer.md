# Entity to ID transformation

Sometimes it is necessary to transform an entity object to its ID
for using it in hidden form fields. Symfony provides a [Data Transformers][1]
which solve this problems. For example, you could to want upload images
with Ajax, store uploaded file on server and persist additional info
about uploaded image (such as filename, mime type, etc.) in database
and then return new entity ID to reference to this image entity in other form.

This bundle provide such data transformer out-of-the-box which allow to
transform any entity to its own ID in simplest way.

## EntityToIdDataTransformer

First, add to your image form field the `EntityToIdDataTransformer`
to allow transformation of image object to its own ID and back.

``` php
// src/AppBundle/Form/Type/PostType.php

<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Post;
use LapaLabs\DoctrineExtensionsBundle\Form\DataTransformer\EntityToIdTransformer;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heading', 'text')
            ->add('description', 'textarea')
            ->add(
                $builder->create('mainImage', 'hidden')
                    ->addModelTransformer(new EntityToIdTransformer($options['em']->getRepository('AppBundle:Image')))
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => Post::class,
            ))
            ->setRequired(array('em'))
            ->setAllowedTypes('em', 'Doctrine\Common\Persistence\ObjectManager')
        ;
    }
}
```

Next, in your controller, you should to pass required instance of `EntityManager`
as third options parameters with `em` key that used to get image entity repository instance
and pass it to the `EntityToIdTransformer` class like in example above.

``` php
<?php
// src/AppBundle/Controller/PostController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;

/**
 * Post controller.
 */
class PostController extends Controller
{
    // Other actions and methods...

    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
            'em' => $this->get('doctrine.orm.entity_manager'),
        ));

        $form->add('create', 'submit', array('label' => 'Create'));

        return $form;
    }
```

> **NOTE** This example assumed that you already have `Post` and `Image` entities
with defined relations between them. You also should to write some code on JavaScript
to upload images with Ajax and put returned IDs of uploaded images in corresponding form fields.

## EntitySelectorType

If you don't want to apply data transformer on your fields you could
to use your custom form type, based on abstract [EntitySelectorType][2] class.

First, create your entity selector class which extends `EntitySelectorType`
and pass to parent construct correct entity repository.

``` php
// src/AppBundle/Form/Type/ImageSelectorType.php

<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use LapaLabs\DoctrineExtensionsBundle\Form\Type\EntitySelectorType;

/**
 * Class ImageSelectorType
 */
class ImageSelectorType extends EntitySelectorType
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em->getRepository('AppBundle:Image'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'image_selector';
    }
}
```

Then you should to define your new custom form type as a service. 

``` yaml
# app/config/services.yml

services:
    app.form.type.image_selector:
        class: AppBundle\Form\Type\ImageSelectorType
        arguments: ["@doctrine.orm.entity_manager"]
        tags:
            - { name: form.type, alias: image_selector }
```

> **NOTE** The alias `image_selector` is important and should to match with one
that returns by `ImageSelectorType::getName()` method. Later this name will be used
in form fields to set field type.

The latest step is to use this alias in any form field type.

``` php
// src/AppBundle/Form/Type/PostType.php

<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Post;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heading', 'text')
            ->add('description', 'textarea')
            ->add('mainImage', 'image_selector')
            ->add('additionalImages', 'collection', [
                'type' => 'image_selector',
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'by_reference' => false,
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => Post::class,
            ))
        ;
    }
}
```

> **NOTE** This example assumed that you already have `Post` and `Image` entities
with defined relations between them. You also should to write some code on JavaScript
to upload images with Ajax and put returned IDs of uploaded images in corresponding form fields.


[1]: http://symfony.com/doc/current/cookbook/form/data_transformers.html
[2]: https://github.com/LapaLabs/DoctrineExtensionsBundle/blob/master/Form/Type/EntitySelectorType.php
