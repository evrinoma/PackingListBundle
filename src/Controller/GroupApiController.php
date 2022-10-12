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
use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupInvalidException;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Facade\Group\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class GroupApiController extends AbstractWrappedApiController implements ApiControllerInterface
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
     * @Rest\Post("/api/packing_list/group/info/create", options={"expose": true}, name="api_packing_list_group_info_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create groupure packing list",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\GroupApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\GroupApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create group info")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $groupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_GROUP;

        try {
            $this->facade->post($groupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create group info', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/group/info/save", options={"expose": true}, name="api_packing_list_group_info_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save groupure packing list for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\GroupApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\GroupApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save group info")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $groupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_GROUP;

        try {
            $this->facade->put($groupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save group info', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/group/info/delete", options={"expose": true}, name="api_packing_list_group_info_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\GroupApiDto",
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
     * @OA\Response(response=200, description="Delete group info")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $groupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($groupApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete group info', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/group/info/criteria", options={"expose": true}, name="api_packing_list_group_info_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\GroupApiDto",
     *             readOnly=true
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return group info")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var GroupApiDtoInterface $groupApiDto */
        $groupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_GROUP;

        try {
            $this->facade->criteria($groupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get group info', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/group/info", options={"expose": true}, name="api_packing_list_group_info")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\GroupApiDto",
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
     *             default="9",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return group info")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var GroupApiDtoInterface $groupApiDto */
        $groupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_GROUP;

        try {
            $this->facade->get($groupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get group info', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof GroupCannotBeCreatedException:
            case $e instanceof GroupCannotBeRemovedException:
            case $e instanceof GroupCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof GroupNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof GroupInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
