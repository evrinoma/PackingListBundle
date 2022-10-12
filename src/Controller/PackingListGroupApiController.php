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
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Facade\PackingListGroup\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class PackingListGroupApiController extends AbstractWrappedApiController implements ApiControllerInterface
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
     * @Rest\Post("/api/packing_list/group/create", options={"expose": true}, name="api_packing_list_group_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create packing list group",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create packing list group")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $packingListGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_PACKING_LIST_GROUP;

        try {
            $this->facade->post($packingListGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create packing list group', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/group/save", options={"expose": true}, name="api_packing_list_group_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save packing list for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save packing list group")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $packingListGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_PACKING_LIST_GROUP;

        try {
            $this->facade->put($packingListGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save packing list group', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/group/delete", options={"expose": true}, name="api_packing_list_group_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto",
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
     * @OA\Response(response=200, description="Delete packing list group")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $packingListGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($packingListGroupApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete packing list group', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/group/criteria", options={"expose": true}, name="api_packing_list_group_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *             default="1116",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return packing list group")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var PackingListGroupApiDtoInterface $packingListGroupApiDto */
        $packingListGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_PACKING_LIST_GROUP;

        try {
            $this->facade->criteria($packingListGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get packing list group', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/group", options={"expose": true}, name="api_packing_list_group")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto",
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
     *             default="2",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return packing list group")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var PackingListGroupApiDtoInterface $packingListGroupApiDto */
        $packingListGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_PACKING_LIST_GROUP;

        try {
            $this->facade->get($packingListGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get packing list group', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof PackingListGroupCannotBeCreatedException:
            case $e instanceof PackingListGroupCannotBeRemovedException:
            case $e instanceof PackingListGroupCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof PackingListGroupNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof PackingListGroupInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
