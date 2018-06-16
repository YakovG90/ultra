<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/15/2018
 * Time: 10:26 PM
 */

namespace App\Controller;


use App\Entity\Member;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /** @Route("/admin", name="admin") */
    public function index(Request $request)
    {
        $member = $this->getUser();
        $bindings = [
            'member' => $member,
        ];

        return $this->render('admin/admin.html.twig', $bindings);
    }

    /** @Route("/admin/members/", name="admin_list_members") */
    public function listUsers(Request $request)
    {
        $members = $this->getDoctrine()->getRepository(Member::class)
            ->getMembers();

        $bindings = [
            'members' => $members
        ];

        return $this->render('admin/list-member.html.twig', $bindings);
    }


    /** @Route("/admin/members/edit/{memberId}"), name="admin_edit_member" */
    public function editMember(Request $request, $memberId)
    {
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($memberId);


        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $success = $this->getDoctrine()->getRepository(Member::class)
                ->updateMember($member, $data);

            if ($success) {
                $this->addFlash('success', 'Member was successfully updated!');
                $this->redirectToRoute('admin_list_members');
            }
        }

        $bindings = [
            'member' => $member
        ];

        return $this->render('admin/edit-member.html.twig', $bindings);
    }

    /** @Route("/admin/{userId}/", name="admin_profile") */
    public function editProfile(Request $request, $userId)
    {
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($userId);

        $bindings = [
            'member' => $member
        ];

        return $this->render('admin/admin-profile.html.twig', $bindings);
    }
}