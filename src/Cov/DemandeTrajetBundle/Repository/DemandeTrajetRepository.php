<?php
/**
 * Created by PhpStorm.
 * User: Clevo
 * Date: 17/02/2017
 * Time: 14:27
 */

namespace Cov\DemandeTrajetBundle\Repository;


use Doctrine\ORM\EntityRepository;

class DemandeTrajetRepository extends EntityRepository
{
    /*
    public function findDemandeTrajet($str)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT demandeTrajet FROM CovDemandeTrajetBundle:DemandeTrajet demandeTrajet WHERE demandeTrajet.id LIKE :text 
OR demandeTrajet.etat LIKE :text
 OR demandeTrajet.dateAjout LIKE :text
  OR demandeTrajet.deteDemandee LIKE :text
   OR demandeTrajet.description LIKE :text");
        $query->setParameter('text', '%'.$str.'%');

        return $query->getResult();
    }
*/
}