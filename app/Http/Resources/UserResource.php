<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "rule" => $this->rule,
            "rules" => $this->getRoles($this),
            "created_at" => $this->created_at,
            "deleted_at" => $this->deleted_at,
        ];
        // return parent::toArray($request);
    }

    public function getRoles($user)
    {
        $r = [];
        foreach ($user->rules as $rule) {
            array_push($r, $rule->name);
        }
        return $r;
    }
}
