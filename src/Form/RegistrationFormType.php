<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userNom', TypeTextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre nom'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit comporter au moins 2 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('userPrenom', TypeTextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Prénom'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre prénom'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit comporter au moins 2 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('userAdresse', TypeTextType::class, [
                'label' => 'Adresse',
                'attr' => ['placeholder' => 'Adresse'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre adresse'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'L\'adresse doit comporter au moins 2 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s0-9]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('userCP', TypeTextType::class, [
                'label' => 'Code Postal',
                'attr' => ['placeholder' => 'Code Postal'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre code postal'
                    ]),
                    new Length([
                        'min' => '5',
                        'minMessage' => 'Le code postal doit comporter au moins 5 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 5,
                    ]),
                    new Regex(['pattern' => '/^[0-9]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('userVille', TypeTextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Ville'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre ville'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de la ville doit comporter au moins 2 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('userPays', TypeTextType::class, [
                'label' => 'Pays',
                'attr' => ['placeholder' => 'Pays'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre pays'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom du pays doit comporter au moins 3 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(['pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/', 
                                'message' => 'Caratère(s) non valide(s)'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'E-mail'],
                'required' => true,
                'help' => 'Le message de confirmation sera envoyé à cette adresse mail',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre adresse mail'
                    ]),
                    new Regex(['pattern' => '/^[a-zA-Z0-9._-]{2,}@[a-zA-Z0-9._-]{3,}\.[a-zA-Z]{2,4}$/', 
                                'message' => 'Adresse mail non valide(s)'
                    ])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['placeholder' => 'Mot de passe', 'autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit comporter au moins 8 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('userCategorie', ChoiceType::class, [
                'label' => 'Vous êtes',
                'label_attr' => ['class' => 'radio-inline'],
                'choices' => [
                        'professionnel' => 'professionnel', 
                        'particulier' => 'particulier',
                ],
                'expanded' => true, 
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez cocher l'une des cases",
                    ]),
                ]
             ]) 
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
