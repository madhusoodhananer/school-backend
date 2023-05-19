<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $gender = config('constants.general.GENDER');
        $memberType = config('constants.general.MEMBER_TYPE');
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'address'       => $this->address,
            'mobile_number' => $this->mobile_number,
            'dob'           => $this->dob,
            'gender'        => $gender[$this->gender],
            'member_type'   => $memberType[$this->member_type],
            'country' => $this->


        ];
    }
}
