<?php

namespace App\Http\Resources\Configuration;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ConfigurationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'domain' => $this->domain,
                'name' => $this->name,
                'business_name' => $this->business_name,
                'slogan' => $this->slogan,
                'email' => $this->email,
                'phone' => $this->phone,
                'logo' => $this->logo,
                'status' =>  $this->status
            ],
            'url' => Storage::disk('configurations')->url($this->logo)
        ];
    }
}
