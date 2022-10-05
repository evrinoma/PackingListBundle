<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PackingListBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Facade\PackingList\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class PackingListApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/packing_list/create", options={"expose": true}, name="api_packing_list_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create packing list",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create packing list")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_PACKING_LIST;

        try {
            $this->facade->post($packingListApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create packing list', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/save", options={"expose": true}, name="api_packing_list_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save packing list for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save packing list")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_PACKING_LIST;

        try {
            $this->facade->put($packingListApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save packing list', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/delete", options={"expose": true}, name="api_packing_list_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete packing list")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($packingListApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete packing list', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/criteria", options={"expose": true}, name="api_packing_list_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *             readOnly=true
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return packing list")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_PACKING_LIST;

        try {
            $this->facade->criteria($packingListApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get packing list', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list", options={"expose": true}, name="api_packing_list")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="1000",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return packing list")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_PACKING_LIST;

        try {
            $this->facade->get($packingListApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get packing list', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof PackingListCannotBeCreatedException:
            case $e instanceof PackingListCannotBeRemovedException:
            case $e instanceof PackingListCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof PackingListNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof PackingListInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
