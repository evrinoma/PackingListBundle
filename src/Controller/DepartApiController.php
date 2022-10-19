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
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartInvalidException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Facade\Depart\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class DepartApiController extends AbstractWrappedApiController implements ApiControllerInterface
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
     * @Rest\Post("/api/packing_list/depart/create", options={"expose": true}, name="api_packing_list_depart_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create departure packing list",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\DepartApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\DepartApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create depart")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $departApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_DEPART;

        try {
            $this->facade->post($departApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create depart', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/depart/save", options={"expose": true}, name="api_packing_list_depart_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save departure packing list for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\DepartApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\DepartApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save depart")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $departApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_DEPART;

        try {
            $this->facade->put($departApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save depart', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/depart/delete", options={"expose": true}, name="api_packing_list_depart_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\DepartApiDto",
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
     *             default="64",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete depart")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $departApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($departApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete depart', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/depart/criteria", options={"expose": true}, name="api_packing_list_depart_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\DepartApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Packing List Entity Id ",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *             default="10",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Packing List Group Entity Id ",
     *         in="query",
     *         name="group[id]",
     *         @OA\Schema(
     *             type="string",
     *             default="6",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Warehouse point name",
     *         in="query",
     *         name="point",
     *         @OA\Schema(
     *             type="string",
     *             default="ЧГРК_№3",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Warehouse type",
     *         in="query",
     *         name="type",
     *         @OA\Schema(
     *             type="string",
     *             default="PACKING_LIST_GROUP_INFO",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return depart")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var DepartApiDtoInterface $departApiDto */
        $departApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_DEPART;

        try {
            $this->facade->criteria($departApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get depart', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/depart", options={"expose": true}, name="api_packing_list_depart")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\DepartApiDto",
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
     *             default="64",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return depart")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var DepartApiDtoInterface $departApiDto */
        $departApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_DEPART;

        try {
            $this->facade->get($departApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get depart', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof DepartCannotBeCreatedException:
            case $e instanceof DepartCannotBeRemovedException:
            case $e instanceof DepartCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof DepartNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof DepartInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
