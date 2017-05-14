<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('demandetrajet_index', new Route(
    '/',
    array('_controller' => 'CovDemandeTrajetBundle:DemandeTrajet:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('demandetrajet_show', new Route(
    '/{id}/show',
    array('_controller' => 'CovDemandeTrajetBundle:DemandeTrajet:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('demandetrajet_new', new Route(
    '/new',
    array('_controller' => 'CovDemandeTrajetBundle:DemandeTrajet:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('demandetrajet_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'CovDemandeTrajetBundle:DemandeTrajet:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('demandetrajet_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'CovDemandeTrajetBundle:DemandeTrajet:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
