<?php

namespace App\Forms;

use Illuminate\Validation\Rules\Password;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    /**
     * Formulaire de gestion des utilisateurs
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    public function buildForm()
    {
        $this->add(
            'name',
            'text',
            [
                'label' => "Nom d'utilisateur",
                'attr' => [
                    'class' => 'form-control',
                    'required' => true,
                    'placeholder' => "Entrez le nom de l'utilisateur ici"
                ],
                'rules' => [
                    'required',
                    'string',
                    'alpha',
                ]
            ]
        )->add(
            'email',
            'email',
            [
                'label' => "Adresse E-mail de l'utilisateur",
                'attr' => [
                    'class' => 'form-control',
                    'required' => true,
                    'placeholder' => "Entrez l'adresse E-mail de l'utilisateur ici",
                ],
                'rules' => [
                    'required',
                    'string',
                    'email',
                ]
            ]
        )->add(
            'password',
            'password',
            [
                'label' => "Mot de passe de l'utilisateur",
                'attr' => [
                    'class' => 'form-control',
                    'required' => true,
                    'placeholder' => "Entrez le mot de passe de l'utilisateur ici"
                ],
                'rules' => [
                    Password::min(8)
                        ->letters()
                        ->numbers()
                        ->mixedCase()
                        ->symbols()
                ]
            ]
        )->add(
            'rule',
            'choice',
            [
                'label' => "Role de l'utilisateur",
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    'admin' => 'Admin',
                    'owner' => 'Propriétaire',
                ],
                'default_value' => 'owner'
            ]
        )->add(
            'submit',
            'submit',
            [
                'label' => empty($this->getModel()->id) ? "Créer" : "Modifier",
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]
        );

        if ($this->getModel() && $this->getModel()->id) {
            $url = route('user_update', $this->getModel()->id);
            empty($this->getModel()->deleted_at) ?: $this->remove('submit');
            $this->remove('password');
        } else {
            $url = route('user_store');
            $this->addAfter(
                'submit',
                'reset',
                'reset',
                [
                    'label' => 'Reset',
                    'attr' => [
                        'class' => 'btn btn-danger'
                    ]
                ]
            );
        }

        $this->formOptions = [
            'method' => empty($this->getModel()->id) ? "POST" : "PUT",
            'url' => $url,
        ];
    }
}
