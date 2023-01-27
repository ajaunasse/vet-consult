<?php

namespace App\Repository;

use App\Entity\ConsultationFlowExamens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsultationFlowExamens>
 *
 * @method ConsultationFlowExamens|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsultationFlowExamens|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsultationFlowExamens[]    findAll()
 * @method ConsultationFlowExamens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsultationFlowExamensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsultationFlowExamens::class);
    }

    public function save(ConsultationFlowExamens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConsultationFlowExamens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ConsultationFlowExamens[] Returns an array of ConsultationFlowExamens objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConsultationFlowExamens
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
