<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/15/2018
 * Time: 10:26 PM
 */

namespace App\Controller;


use App\Entity\Member;
use App\Form\EditMemberEmailType;
use App\Form\EditMemberNameType;
use App\Form\EditMemberPasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends Controller
{

    /** @Route("/admin", name="admin") */
    public function index()
    {
        $member = $this->getUser();
        $bindings = [
            'member' => $member,
        ];

        return $this->render('admin/admin.html.twig', $bindings);
    }

    /** @Route("/admin/members/", name="admin_list_members") */
    public function listUsers()
    {
        $members = $this->getDoctrine()->getRepository(Member::class)
            ->getMembers();

        $bindings = [
            'members' => $members
        ];

        return $this->render('admin/list-member.html.twig', $bindings);
    }


    /** @Route("/admin/members/edit/{memberId}"), name="admin_edit_member"
     * @param Request $request
     * @param $memberId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMember($memberId)
    {
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($memberId);
        $bindings = [
            'member' => $member,
        ];

        return $this->render('admin/edit-member.html.twig', $bindings);
    }

    /** @Route("/admin/edit/{memberId}/edit-password", name="admin_edit_member_password")
     * @param Request $request
     * @param $memberId
     * @param PasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMemberPassword(Request $request, $memberId, UserPasswordEncoderInterface $passwordEncoder)
    {
        // TODO:: BAD BAD BAD REFACTOR THIS INTO ONE ACTION!!
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($memberId);
        $passwordForm = $this->createForm(EditMemberPasswordType::class);
        $passwordForm->handleRequest($request);

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $password = $passwordEncoder->encodePassword($member, $passwordForm->get('plainPassword')->getData());
            $member->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();
        }
        $bindings = [
            'member' => $member,
            'passwordForm' => $passwordForm->createView()
        ];

        return $this->render('admin/edit-member-password.html.twig', $bindings);
    }

    /** @Route("/admin/edit/{memberId}/edit-email", name="admin_edit_member_email")
     * @param Request $request
     * @param $memberId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMemberEmail(Request $request, $memberId)
    {
        // TODO:: BAD BAD BAD REFACTOR THIS INTO ONE ACTION!!
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($memberId);
        $emailForm = $this->createForm(EditMemberEmailType::class);
        $emailForm->handleRequest($request);

        if ($emailForm->isSubmitted() && $emailForm->isValid()) {
            $member->setEmail($emailForm->get('email')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();
        }

        $bindings = [
            'member' => $member,
            'emailForm' => $emailForm->createView()
        ];

        return $this->render('admin/edit-member-email.html.twig', $bindings);
    }

    /**
     * @Route("/admin/edit/{memberId}/edit-username", name="admin_edit_member_username")
     * @param Request $request
     * @param $memberId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMemberName(Request $request, $memberId)
    {
        // TODO:: BAD BAD BAD REFACTOR THIS INTO ONE ACTION!!
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($memberId);
        $usernameForm = $this->createForm(EditMemberNameType::class);

        $usernameForm->handleRequest($request);
        if ($usernameForm->isSubmitted() && $usernameForm->isValid()) {
            $member->setUsername($usernameForm->get('username')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();
        }

        $bindings = [
            'member' => $member,
            'usernameForm' => $usernameForm->createView(),
        ];

        return $this->render('admin/edit-member-username.html.twig', $bindings);
    }

    /** @Route("/admin/{userId}/", name="admin_profile") */
    public function editProfile($userId)
    {
        $member = $this->getDoctrine()->getRepository(Member::class)
            ->getMemberById($userId);

        $bindings = [
            'member' => $member
        ];

        return $this->render('admin/admin-profile.html.twig', $bindings);
    }
}