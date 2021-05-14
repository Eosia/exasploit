<?php

namespace App\Form;

use Mael\MaelRecaptchaBundle\Type\MaelRecaptchaCheckboxType;
use Mael\MaelRecaptchaBundle\Validator\MaelRecaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'minMessage' => "Veuillez saisir minimum 6 caractères"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'exemple@mail.com',
                ]
            ])

            ->add('objet', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Veuillez saisir minimum 10 caractères"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Objet du message',
                ]
            ])

            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Veuillez saisir minimum 10 caractères"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Votre message (minimum 10 caractères.)',
                    'rows' => 10,
                ]
            ])

            ->add('captcha_checkvox', MaelRecaptchaCheckboxType::class, [
                'constraints' =>[
                    new MaelRecaptcha()
                ]
            ])

            ->add('envoyer', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here


        ]);
    }
}
