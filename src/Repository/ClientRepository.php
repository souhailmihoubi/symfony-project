<?php

namespace App\Repository;

use PDO;
use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function save(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getClientsByProduct($lib)
    {
        $sql = "SELECT c.*       
                FROM client c
                INNER JOIN commande cm ON c.id = cm.cod_c_id
                INNER JOIN pc  ON pc.num_c_id = cm.id
                INNER JOIN produit p ON p.id = pc.cod_p_id
                WHERE p.lib = ?";

        $statement = $this->_em->getConnection()->prepare($sql);
        $statement->bindValue(1 , $lib);
        $result = $statement->executeQuery()->fetchAllAssociative();
        return $result;
    }

    public function getClientByVille($ville)
    {
        
        $sql = "SELECT COUNT(*)       
                FROM client
                WHERE client.adr_c LIKE CONCAT('%',:ville,'%') ";

        $statement = $this->_em->getConnection()->prepare($sql);
        $statement->bindValue(":ville" , $ville);
        $result = $statement->executeQuery()->fetchAllAssociative();
        return $result;
    }

    public function getClientByDate($date1,$date2)
    {
        $sql = "SELECT c.*       
        FROM client c
        INNER JOIN commande cm ON c.id = cm.cod_c_id
    
        WHERE cm.dat_c BETWEEN :date1 AND :date2 ";

        $statement = $this->_em->getConnection()->prepare($sql);
        $statement->bindValue(':date1', $date1);
        $statement->bindValue(':date2' , $date2);
        $result = $statement->executeQuery()->fetchAllAssociative();
        return $result;
    }

    public function getMinQuantity()
    {
        $sql = "SELECT p.lib AS Nom, min(p.qte_s) AS Quantite      
        FROM produit p
        group by p.id";

        $statement = $this->_em->getConnection()->prepare($sql);
        $result = $statement->executeQuery()->fetchAllAssociative();
        return $result;
    }

    
    //    /**
    //     * @return Client[] Returns an array of Client objects
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

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
