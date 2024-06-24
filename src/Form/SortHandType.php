<?php

namespace App\Form;

use App\Config\CardConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SortHandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hand', CollectionType::class, [
                'entry_type' => CardType::class,
                'allow_add' => true,
                'constraints' => [
                    new Assert\Count([
                        'min' => CardConfig::HAND_SIZE,
                        'max' => CardConfig::HAND_SIZE,
                        'exactMessage' => 'The hand must contain exactly 10 cards.'
                    ]),
                    new Assert\Valid(),
                ],
            ])
            ->add('colorOrder', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'constraints' => [
                    new Assert\All([
                        new Assert\Choice([
                            'choices' => CardConfig::COLORS,
                            'message' => 'Please pick valid colors.',
                        ])
                    ]),
                    new Assert\Count([
                        'min' => count(CardConfig::COLORS),
                        'max' => count(CardConfig::COLORS),
                        'exactMessage' => 'The colors order must contain exactly {{ limit }} colors.'
                    ]),
                ],
            ])
            ->add('sortOrder', ChoiceType::class, [
                'choices' => array_combine(CardConfig::SORT_VALUES_ORDERS, CardConfig::SORT_VALUES_ORDERS),
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }
}

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Choice([
                        'choices' => CardConfig::COLORS,
                        'message' => 'Choose a valid color.',
                    ]),
                ],
            ])
            ->add('value', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Choice([
                        'choices' => CardConfig::VALUES,
                        'message' => 'Choose a valid value.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }
}
