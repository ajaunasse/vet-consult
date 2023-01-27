<?php

namespace App\Repository;

use App\Entity\MajorInjuryClinicSign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MajorInjuryClinicSign>
 *
 * @method MajorInjuryClinicSign|null find($id, $lockMode = null, $lockVersion = null)
 * @method MajorInjuryClinicSign|null findOneBy(array $criteria, array $orderBy = null)
 * @method MajorInjuryClinicSign[]    findAll()
 * @method MajorInjuryClinicSign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MajorInjuryClinicSignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MajorInjuryClinicSign::class);
    }

    public function save(MajorInjuryClinicSign $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MajorInjuryClinicSign $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MajorInjuryClinicSign[] Returns an array of MajorInjuryClinicSign objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MajorInjuryClinicSign
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
