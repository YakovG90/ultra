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
    private $session ;

    public function __construct(RegistryInterface $registry, Session $session)
    {
        parent::__construct($registry, Member::class);
        $this->session = $session;
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
            $this->session->getFlashBag()->add('warning', 'Das Passwort darf nicht leer sein!');
            return false;
        }

        return true;
    }
}
