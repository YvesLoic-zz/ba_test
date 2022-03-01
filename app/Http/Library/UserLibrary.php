<?php

namespace App\Http\Library;

trait UserLibrary
{
    use Library;

    /**
     * Validation Rules To Be Used When Creating a User
     * @return string[][]
     */
    protected function userValidatedRules(bool $store)
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', $store ? 'unique:users' : null],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rule' => ['required', 'string'],
        ];
    }

    /**
     * Contraintes de validation des attributs utilisateur
     * @return string[]
     */
    protected function userMessagesError()
    {
        return [
            "name.required" => "Le nom d'utilisateur doit etre fourni!",
            "name.string" => "Le nom d'utilisateur doit une chaine de charactères!",
            "name.max" => "Le nom d'utilisateur doit avoir une longueur max de {{limit}} charactères!",

            "email.required" => "L'E-mail de l'utilisateur doit etre fourni!",
            "email.string" => "L'E-mail de l'utilisateur doit une chaine de charactères!",
            "email.email" => "Format de l'E-mail non valide!",
            "email.max" => "L'E-mail doit avoir une longueur max de {limit} charactères!",
            "email.unique" => "Cet E-mail est deja prise, veuillez la remplacer!",

            "password.required" => "Le mot de passe de l'utilisateur doit etre fourni!",
            "password.string" => "Le mot de passe de l'utilisateur doit une chaine de charactères!",
            "password.min" => "Le mot de passe doit avoir une longueur min de {limit} charactères!",
            "password.confirmed" => "les mots de passe ne correspondent pas!",

            "rule.required" => "Le role de l'utilisateur doit etre fourni!",
            "rule.string" => "Le role de l'utilisateur doit une chaine de charactères!",
        ];
    }
}
