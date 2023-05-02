<?php

namespace App\Repository;

use App\Entity\SubExamenClinic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubExamenClinic>
 *
 * @method SubExamenClinic|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubExamenClinic|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubExamenClinic[]    findAll()
 * @method SubExamenClinic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubExamenClinicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubExamenClinic::class);
    }

    public function save(SubExamenClinic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SubExamenClinic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SubExamenClinic[] Returns an array of SubExamenClinic objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SubExamenClinic
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
