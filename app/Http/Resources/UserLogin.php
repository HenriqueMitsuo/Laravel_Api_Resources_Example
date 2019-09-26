<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLogin extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $jwt_token)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        
        $this->jwt_token = $jwt_token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "jwt_token" => $this->jwt_token
        ];
    }
}
