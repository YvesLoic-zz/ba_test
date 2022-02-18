<?php

namespace App\Http\Library;

trait Library
{
    /**
     * Check if the user has admin rule
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isAdmin($user)
    {
        if (!empty($user) && strcmp($user->rule, "admin") == 0) {
            return true;
        }
        return false;
    }

    /**
     * Check if the user has owner rule
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isOwner($user)
    {
        if (!empty($user) && strcmp($user->rule, "owner") == 0) {
            return true;
        }
        return false;
    }

    /**
     * Check if the user is recognize by the system
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isRecognized($user)
    {
        if (!empty($user) && (strcmp($user->rule, "admin") || strcmp($user->rule, "owner"))) {
            return true;
        }
        return false;
    }

    /**
     * Méthode d'affichage des resultats positifs
     *
     * @param mixed  $data    contenu de la reponse JSON
     * @param string $message description
     * @param int    $code    code de l'erreur
     *
     * @return JsonResponse
     */
    protected static function success($data, $message = '', $code = 200)
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'data' => $data,
            ]
        );
    }

    /**
     * Méthode d'affichage des erreurs.
     *
     * @param int    $code    code de l'erreur
     * @param string $message description
     *
     * @return JsonResponse
     */
    protected static function error($code, $message = '', $action)
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'action' => $action
            ]
        );
    }
}
