<?php

namespace oio\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('oioUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
