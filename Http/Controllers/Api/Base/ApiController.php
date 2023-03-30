<?php

namespace App\Http\Controllers\Api\Base;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Core\Main\Traits\ValidationTrait;
use App\Http\Controllers\Api\Interfaces\ApiControllerInterface;
use App\Http\Controllers\Api\Traits\CommonComponents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Nette\Schema\ValidationException as ValidatorException;

use Illuminate\Validation\ValidationException;
abstract class ApiController extends Controller implements ApiControllerInterface
{
    use CommonComponents, ValidationTrait;

    protected \Illuminate\Http\Request $request;

    public function __construct()
    {
        $this->request = Request::instance();
    }

    protected function validateRequest(array $rules)
    {
        $this->validating($this->request->all(), $rules);
    }

    protected function result($result, $status = 200)
    {
        return response()->json([
            self::PREFIX_RESULT => $result
        ], $status);
    }

    protected function errors($errors, $status = 400)
    {
        return response()->json([
            self::PREFIX_ERRORS => $errors,
        ], $status);
    }

    protected function saveResponse(\Closure $closure, int $errorStatus = 400)
    {
        try {
            return $closure();
        } catch(ValidationException $exception) {
            $errors = $this->errorResult($exception->validator);
            Log::error($errors);
            Log::error($exception->getTraceAsString());
            return $this->errors($errors, self::VALIDATION_ERROR);
        } catch (ValidatorException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            return $this->errors($exception->getMessage(), self::VALIDATION_ERROR);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            return $this->errors($exception->getMessage(), $errorStatus);
        }
    }

    protected function create(BaseService $service, array $data, $status = 201, $errorStatus = 400)
    {
        return $this->saveResponse(function () use ($service, $data, $status) {
            return $this->result($service->create($data), $status);
        }, $errorStatus);
    }

    protected function createFast(BaseService $service, $status = 201, $errosStatus = 400)
    {
        return $this->create($service, $this->request->all(), $status, $errosStatus);
    }

    /**
     * @param BaseService $service
     * @param \Closure $response_callback
     * @param array $data
     * @param int $errorStatus
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createCustom(BaseService $service, \Closure $response_callback, array $data = [], int $errorStatus = 400): \Illuminate\Http\JsonResponse
    {
        return $this->saveResponse(function () use ($service, $response_callback, $data) {
            return $response_callback($service->create(array_merge(Request::all(), $data)));
        }, $errorStatus);
    }

    protected function update(BaseService $service, $object, array $data = [], $status = 201, $errorStatus = 400)
    {
        return $this->saveResponse(function () use ($service, $object, $data, $status) {
            return $this->result($service->update($object, $data), $status);
        }, $errorStatus);
    }

    protected function updateFast(BaseService $service, $object, $status = 201, $errosStatus = 400)
    {
        return $this->update($service, $object, $this->request->all(), $status, $errosStatus);
    }

    protected function updateCustom(BaseService $service, $object, \Closure $response, array $data = [], $errorStatus = 400)
    {
        return $this->saveResponse(function () use ($service, $object, $response, $data) {
            return $response($service->update($object, array_merge($this->request->all(), $data)));
        }, $errorStatus);
    }

    protected function destroy(BaseService $baseService, Entity $entity)
    {
        return $this->saveResponse(function () use ($baseService, $entity) {
            return $baseService->destroy($entity);
        });
    }
}
