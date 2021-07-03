<?php namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Pagination;
use Illuminate\Support;

class JsonService {

    /**
     * @param array|Support\Collection|Pagination\LengthAwarePaginator|Illuminate\Database\Eloquent\Model $source
     * @return JsonResponse
     */
    public function response($source): JsonResponse {
        $jsonResponseData = [
            'data' => [],
            'code' => HTTP_STATUS_CODE_SUCCESS,
        ];

        if (is_array($source) || $source instanceof Support\Collection || get_parent_class($source) === 'Illuminate\Database\Eloquent\Model') {
            // array or "Support\Collection" or Model
            $jsonResponseData['data'] = $source;
        } elseif ($source instanceof Pagination\LengthAwarePaginator) {
            $jsonResponseData['data'] = $source->items();
            $jsonResponseData['links'] = [
                'prev' => $source->previousPageUrl(),
                'next' => $source->nextPageUrl(),
            ];
        } else {
            throw new \Exception('Unsupported type of source');
        }

        return new JsonResponse($jsonResponseData, HTTP_STATUS_CODE_SUCCESS);
    }
}
