<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/16/2018
 * Time: 4:48 PM
 */

namespace App\Service;


use App\Entity\Member;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class MemberService
{
    private $message;
    private $entityManager;
    private $container;

    private function __construct(EntityManager $entityManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    public function updateMember(Member $member, array $data)
    {
        if (!$this->basicDataValid($data)) {
            return false;
        }

        $member->setPlainPassword(isset($data['password']));
        $member->setEmail(isset($data['email']));
        $member->setUsername(isset($data['username']));

        $this->getEntityManager()->persist($member);
        $this->getEntityManager()->flush($member);

        return $member;
    }

    public function basicDataValid(array $data)
    {
        if (!isset($data['password']) && !trim($data['password'] == '')) {
            $this->message = ('Das Passwort darf nicht leer sein!');
            return false;
        }

        return true;
    }
}