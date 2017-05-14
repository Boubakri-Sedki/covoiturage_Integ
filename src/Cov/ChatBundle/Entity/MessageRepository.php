<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 19/02/2017
 * Time: 16:40
 */

namespace Cov\ChatBundle\Entity;
use Doctrine\ORM\EntityRepository;


class MessageRepository extends EntityRepository
{

    public function findMsg()
    {

        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM CovChatBundle:Message m WHERE m.id>:num ORDER BY m.id ASC ');
        $query->setParameter('num', 0);

        return $query->getResult();
    }


    public function findMsgByUsers($id1,$id2)
    {

        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM CovChatBundle:Message m WHERE (m.user=:id1 AND m.user2=:id2) OR (m.user2=:id1 AND m.user=:id2) ORDER BY m.id DESC');
        $query->setParameter('id1', $id1);
        $query->setParameter('id2', $id2);

        return $query->getResult();
    }

    public function updateMsg($num,$id1,$id2)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM CovChatBundle:Message m WHERE (m.id>:num) AND ((m.user=:id1 AND m.user2=:id2) OR (m.user2=:id1 AND m.user=:id2) )  ORDER BY m.id DESC');
        $query->setParameter('num', $num);
        $query->setParameter('id1', $id1);
        $query->setParameter('id2', $id2);

        return $query->getResult();

    }



}