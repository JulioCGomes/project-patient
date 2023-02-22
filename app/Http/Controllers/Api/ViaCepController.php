<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\ViaCep\ViaCepInterface;
use Exception;

class ViaCepController extends Controller
{
    /** @var ViaCepInterface $viaCepInterface */
    private $viaCepInterface;

    /**
     * Construtor do controller ApostaController
     *
     * @param ViaCepInterface $viaCepInterface
     */
    public function __construct(
        ViaCepInterface $viaCepInterface
    ) {
        $this->viaCepInterface = $viaCepInterface;
    }

    /**
     * List via cep.
     *
     * @return mixed
     */
    public function index($cep)
    {
        try {
            return $this->viaCepInterface->getInfoCep((string) $cep);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
