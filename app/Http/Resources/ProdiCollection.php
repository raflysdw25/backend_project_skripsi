<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

// use App\Http\Resources\ProdiResource;

class ProdiCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'result';
    public function toArray($request)
    {       
        return ProdiResource::collection($this->collection);
    }

    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        $meta = $jsonResponse['meta'];
        $jsonResponse['page'] = [
            "current" => $meta['current_page'],
            "total" => $meta['last_page'],
            "size" => $meta['per_page'],
            "data_total" => $meta['total']
        ];
        unset($jsonResponse['links'], $jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse));
        
    }
}
