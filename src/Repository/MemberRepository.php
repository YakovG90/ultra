<?php

namespace App\Repository;

use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Member::class);
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
}
