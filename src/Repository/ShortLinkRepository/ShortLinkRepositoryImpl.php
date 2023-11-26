<?php

namespace App\Repository\ShortLinkRepository;

use App\Entity\ShortLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<ShortLink>
 * @method ShortLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShortLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShortLink[]    findAll()
 * @method ShortLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShortLinkRepositoryImpl
    extends ServiceEntityRepository
    implements ShortLinkRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortLink::class);
    }

    public function save(ShortLink $shortLink): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($shortLink);
        $entityManager->flush();
    }

    public function insertOrUpdate(ShortLink $shortLink): array
    {
        $shortLinkExisting = $this->findOneBy(['baseUrl' => $shortLink->getBaseUrl()]);

        if (!$shortLinkExisting) {
            $this->save($shortLink);

            return ['status' => 'added', 'message' => 'Short link added successfully', 'code' => Response::HTTP_CREATED];
        } else {
            $updatedAt = new \DateTimeImmutable();
            $shortLinkExisting->setUpdatedAt($updatedAt);

            $this->save($shortLinkExisting);

            return ['status' => 'updated', 'message' => 'Short link updated successfully', 'code' => Response::HTTP_OK];
        }
    }

//    /**
//     * @return ShortLink[] Returns an array of ShortLink objects
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

//    public function findOneBySomeField($value): ?ShortLink
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
