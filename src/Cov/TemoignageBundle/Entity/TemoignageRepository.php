<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 09/02/2017
 * Time: 13:50
 */

namespace Cov\TemoignageBundle\Entity;
use Doctrine\ORM\EntityRepository;


class TemoignageRepository extends EntityRepository
{

    public function accepterTemoignage($id)
    {
        $query = $this->getEntityManager()
            ->createQuery('UPDATE CovTemoignageBundle:Temoignage t SET t.statut= :nvstatut , t.dateValidation= :nvdate WHERE t.id = :idModele');
        $query->setParameter('nvstatut', 1);
        $query->setParameter('idModele', $id);
        $query->setParameter('nvdate', new \DateTime());

        $query->execute();
    }

    public function refuserTemoignage($id)
    {
        $query = $this->getEntityManager()
            ->createQuery('UPDATE CovTemoignageBundle:Temoignage t SET t.statut= :nvstatut , t.dateValidation= :nvdate WHERE t.id = :idModele');
        $query->setParameter('nvstatut', -1);
        $query->setParameter('idModele', $id);
        $query->setParameter('nvdate', new \DateTime());
        $query->execute();
    }

    public function chercherTemoignage($str)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT t FROM CovTemoignageBundle:Temoignage t WHERE t.user.username LIKE :text OR t.contenu LIKE :text OR t.statut LIKE :text');
        $query->setParameter('text', '%x%');

       return $query->getResult();
    }

    public function updateTemoignage($id , $content)
    {
        $query = $this->getEntityManager()
            ->createQuery('UPDATE CovTemoignageBundle:Temoignage t SET t.contenu =:content WHERE t.id =:text ');
        $query->setParameter('text', $id);
        $query->setParameter('content', $content);

        $query->execute();
    }

    public function findTemoignage($str)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t FROM CovTemoignageBundle:Temoignage t JOIN t.user u WHERE u.username LIKE :text");
        $query->setParameter('text', '%'.$str.'%');

        return $query->getResult();
    }

    public function rechercherTemoignage(\Datetime $date, \Datetime $date2,  \Datetime $datev1,  \Datetime $datev2, $st )
    {
        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($date2->format("Y-m-d")." 23:59:59");
        $fromv = new \DateTime($datev1->format("Y-m-d")." 00:00:00");
        $tov = new \DateTime($datev2->format("Y-m-d")." 23:59:59");


        if($st != null) {
            $qb = $this->createQueryBuilder("e");
            $qb
                ->andWhere('e.dateAjout BETWEEN :from AND :to')
                ->andWhere('e.dateValidation BETWEEN :fromv AND :tov')
                ->andWhere('e.statut =:st')
                ->setParameter('from', $from)
                ->setParameter('to', $to)
                ->setParameter('fromv', $fromv)
                ->setParameter('tov', $tov)
                ->setParameter('st', $st);


            $result = $qb->getQuery()->getResult();
        }
        else{
            $qb = $this->createQueryBuilder("e");
            $qb
                ->andWhere('e.dateAjout BETWEEN :from AND :to')
                ->andWhere('e.dateValidation BETWEEN :fromv AND :tov')
                ->setParameter('from', $from)
                ->setParameter('to', $to)
                ->setParameter('fromv', $fromv)
                ->setParameter('tov', $tov);



            $result = $qb->getQuery()->getResult();

        }

        return $result;
    }


}