<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Entity\User\MemberUser;
use App\Repository\MemberUserRepository;
use App\Service\APIMemberManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberUserController.
 *
 * @Route("/api/member_users")
 */
class MemberUserController extends Controller
{
    /**
     * An library management system subscribed member.
     *
     * @var MemberUser
     */
    private $member;

    /**
     * Members repository.
     *
     * @var MemberUserRepository
     */
    private $memberRepository;

    /**
     * API Member Manager.
     *
     * @var APIMemberManager
     */
    private $apiMemberManagement;

    /**
     * MemberUserController constructor.
     *
     * @param MemberUserRepository $memberRepository    Member's Repository
     * @param APIMemberManager $apiMemberManagement API Member Manager
     */
    public function __construct(
        MemberUserRepository $memberRepository,
        APIMemberManager $apiMemberManagement
    ) {
        $this->memberRepository = $memberRepository;
        $this->apiMemberManagement = $apiMemberManagement;
    }

    /**
     * Count all members.
     *
     * @Route(
     *     "/count",
     *     name="api_member_user_count",
     *     defaults={
     *          "#_api_resource_class"=MemberUser::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        $membersCount = $this->memberRepository->count([]);

        return new JsonResponse(['membersCount' => $membersCount]);
    }

    /**
     * Return connected user.
     *
     * @Route(
     *     "/current",
     *     name="api_member_user_current",
     *     defaults={
     *          "_api_item_operation_name"="get_current",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @return JsonResponse
     */
    public function current()
    {
        return new JsonResponse($this->getUser());
    }

    /**
     * Subscribe an giving user by adding him into database.
     *
     * @param Request $request HTTP request
     * @param APIMemberManager $manager API Member Manager
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/subscribe",
     *     name="api_member_user_subscribe",
     *     defaults={
     *          "_api_item_operation_name"="get_subscribe",
     *          "_api_receive"=false
     *      }
     * )
     */
    public function subscribe(
        Request $request,
        APIMemberManager $manager
    ) {
        $this->member = $manager->subscribe($request);

        return new JsonResponse($this->member);
    }
}
