<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class FilterType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class FilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add(
//                'sector.ticker',
//                TextType::class,
//                array(
//                    'label'    => false,
//                    'required' => true,
//                    'attr'     => array(
//                        'placeholder' => 'Ticker',
//                    ),
//                )
//            )
//            ->add(
//                'sector.title',
//                TextType::class,
//                array(
//                    'label'    => false,
//                    'required' => true,
//                    'attr'     => array(
//                        'placeholder' => 'Sector',
//                    ),
//                )
//            )
//            ->add(
//                'stock.ticker',
//                TextType::class,
//                array(
//                    'label'    => false,
//                    'required' => true,
//                    'attr'     => array(
//                        'placeholder' => 'Ticker',
//                    ),
//                )
//            )
//            ->add(
//                'stock.title',
//                TextType::class,
//                array(
//                    'label'    => false,
//                    'required' => true,
//                    'attr'     => array(
//                        'placeholder' => 'Stock',
//                    ),
//                )
//            )
            ->add(
                'screener',
                EntityType::class,
                array(
                    'label'    => false,
                    'class' => 'AppBundle\Entity\Screener',
                    'required' => true,
                    'attr'     => array(
//                        'placeholder' => 'Screener',
                    ),
                )
            )
//            ->add(
//                'value',
//                NumberType::class,
//                array(
//                    'label'    => false,
//                    'required' => true,
//                    'attr'     => array(
//                        'placeholder' => 'Value',
//                    ),
//                )
//            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label' => 'front.contact.form.ok',
                    'attr'  => array(
                        'class' => 'btn-default',
                    ),
                )
            );
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'myblock';
    }

    /**
     * @param OptionsResolver $resolver
     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(
//            array(
//                'data_class' => 'AppBundle\Entity\Screener',
//            )
//        );
//    }
}
