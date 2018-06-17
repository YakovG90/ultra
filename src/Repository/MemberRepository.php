<?php

namespace App\Repository;

use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{

    private $messages;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Member::class);
    }

    public function getMessage()
    {
        return $this->messages;
    }

    public function getMembers()
    {
        return $this->findAll();
    }

    public function getMemberById($id)
    {
        return $this->find($id);
    }

    public function getMemberByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function getMemberByRole($roles)
    {
        return $this->findOneBy(['roles' => $roles]);
    }

    public function updateMember(Member $member, array $data)
    {
        if (!$this->basicDataValid($data)) {
            return false;
        }
        $member->setPlainPassword($data['password']);
        $member->setEmail($data['email']);
        $member->setUsername($data['username']);

        $this->getEntityManager()->persist($member);
        $this->getEntityManager()->flush($member);

        return $member;
    }

    public function basicDataValid(array $data)
    {
        if (empty($data['password']) && trim($data['password'] === '')) {
            $this->messages = ('Das Passwort darf nicht leer sein!');
            return false;
        }

        return true;
    }
}
