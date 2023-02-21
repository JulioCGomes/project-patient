<?php

namespace App\Utils\ViaCep;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * Class integration IpInfo.
 *
 * @package IpInfo
 */
class ViaCep implements ViaCepInterface
{
    /**
     * Construct viacep.
     *
     * @param string $urlApi
     */
    public function __construct(
        private string $urlApi,
    ) {
        $this->urlApi = $urlApi;
    }

    /**
     * Get info cep.
     *
     * @param string $cep
     * @return void
     */
    public function getInfoCep(string $cep): array
    {
        return (array) $this->sendRequest((string) $cep);
    }

    /**
     * Send request.
     *
     * @param string $cep
     * @return array
     */
    private function sendRequest(string $cep): array
    {
        try {
            /** @var string $urlRequest */
            $urlRequest = $this->urlApi . '/' . $cep .'/json';

            /** @var \GuzzleHttp\Psr7\Response $request */
            $request = (new Client())->get($urlRequest);

            return json_decode($request->getBody(), true);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}
