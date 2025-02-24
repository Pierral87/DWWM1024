<?php

namespace App\Repository;

use App\Entity\Emprunt;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    //    /**
    //     * @return Livre[] Returns an array of Livre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Livre
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    // On crée une requête qui me donnera les livres non disponibles (ceux qui ont une date rendu NULL dans la table emprunt)

    public function livresNonDisponibles() 
    {
        return $this->createQueryBuilder('l')
            ->join(Emprunt::class, "e", "WITH", "l.id = e.livre") // on parle ici de l'objet représenté dans la bdd, le livre, on ne réfléchis pas en sql pur 
            ->where("e.date_retour IS NULL")
            ->orderBy("l.auteur")
            ->addOrderBy("l.titre")
            ->getQuery()
            ->getResult();
    }
}
