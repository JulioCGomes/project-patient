<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressCreateRequest;
use App\Http\Requests\Address\AddressSearchRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
use App\Http\Resources\AddressResource;
use App\Services\Address\AddressServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /** @var AddressServiceInterface $addressService */
    private $addressService;

    /**
     * Construtor do controller ApostaController
     *
     * @param AddressServiceInterface $addressService
     */
    public function __construct(
        AddressServiceInterface $addressService
    ) {
        $this->addressService = $addressService;
    }

    /**
     * List all address.
     *
     * @return Mixed
     */
    public function index(AddressSearchRequest $request)
    {
        try {
            /** @var string $search */
            $search = data_get($request->validated(), 'search', '');

            /** @var Array|Colletion $arrAddress */
            $arrAddress = $this->addressService->getAllAddress((string) $search);

            return new AddressResource($arrAddress);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Unable to list address. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add address.
     *
     * @param AddressCreateRequest $request
     * @return Json
     */
    public function create(AddressCreateRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var array $dataAddress */
            $dataAddress = $request->validated();

            /** @var array $newAddress */
            $newAddress = $this->addressService->addAddress($dataAddress);

            /** @var AddressResource $address */
            $address = new AddressResource(['data' => [$newAddress]]);

            DB::commit();

            return $address;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to add address. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update address.
     *
     * @param AddressUpdateRequest $request
     * @return Json
     */
    public function update($idAddress, AddressUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var array $dataAddress */
            $dataAddress = $request->validated();

            $dataAddress['id'] = (int) $idAddress;

            /** @var array $updateAddress */
            $updateAddress = $this->addressService->updateAddress($dataAddress);

            /** @var AddressResource $address */
            $address = new AddressResource(['data' => $updateAddress]);

            DB::commit();

            return $address;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to update address. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete address.
     *
     * @param [type] $idAddress
     * @return Json
     */
    public function delete($idAddress)
    {
        DB::beginTransaction();

        try {
            $this->addressService->deleteAddress(intval($idAddress));

            DB::commit();

            return response()->json([
                'deleted' => true
            ], 202);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to delete address. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
