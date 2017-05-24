<?php

namespace oio\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use oio\UserBundle\Entity\User;
use oio\UserBundle\Form\UserType;

class UserController extends Controller

{
    public function indexAction(Request $request)
     {
    
    $em = $this->getDoctrine()->getManager();
    //$users = $em->getRepository('oioUserBundle:User')->findAll();
    /*
    $res = 'lista de usuarios : <br />';
    
    foreach ($users as $user)
    {
        $res .= 'Usuario: '. $user->getUsername() . '- Email: ' . $user->getEmail() . '-Segundo Nombre:' . $user->getLastname() . '<br / >';
    }
       return new Response($res);      
    }
       public function viewAction($nombre)
       {
        
        $repository = $this->getDoctrine()->getRepository('oioUserBundle:User');
        //$user = $repository->find($id);
        $user = $repository->findOneByUsername($nombre);
       return  new Response('Usuario: ' . $user->getUsername() . ' -con el correo- ' . $user->getEmail());   
       } 
     
     */ 
    $dql = "SELECT u FROM oioUserBundle:User u ORDER BY u.id DESC";
    $users = $em->createQuery($dql);
    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $users,$request->query->getInt('page',1),
            4
    );
    
    return $this->render('oioUserBundle:User:index.html.twig', array('pagination' => $pagination));
        
        
        }
        
                   
        public function editAction($id)
        
        {
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('oioUserBundle:User')->find($id);
        
        if(!$user)
        {
            
            throw $this->createNotFoundException('Usuario no creado');
            
        }
            $form = $this->createEditForm($user);
            
            return $this->render('oioUserBundle:User:edit.html.twig', array ('user'=>$user, 'form' => $form->createView()));
        }
        
        private function createEditForm(User $entity)
        {
            $form = $this->createForm(new Usertype(),$entity,array('action'=> $this->generateUrl('oio_user_update', array('id' =>$entity->getId())),'method'=>'PUT'));
            
            return $form;
            
        }
        
        public function  updateAction($id, Request $request)
        {
            $em= $this->getDoctrine()->getManager();
            
            $user = $em->getRepository('oioUserBundle:User')->find($id);
            
            if(!$user)
            {
                   throw $this->createNotFoundException('Usuario no creado');
            }
           
            $form = $this->createEditForm($user);
            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid())
            {
                
              $em->flush();
              $successMessage = $this->get('translator')->trans('El Usuario se creo satisactoriamente.');
                $this->addFlash('mensaje', $successMessage);
              return $this->redirectToRoute('oio_user_edit', array('id' => $user->getId()));
            }       
            return $this->render('oioUserBundle:User:edit.html.twig', array('user'=> $user,'form'=>$form->createView()));
            
            }
        
        

        public function viewsAction($id)
       
        {
        
        $repository = $this->getDoctrine()->getRepository('oioUserBundle:User');
        $user = $repository->find($id);//otra forma especifica
        
       return  new Response('Usuario: ' . $user->getUsername() . ' -con el correo- ' . $user->getEmail());
       
       
       
        }
        
        
        public function addAction()
                {
            $user = new User();
            $form = $this->createCreateForm($user);
            return $this->render('oioUserBundle:User:add.html.twig', array('form' => $form->createView
                    ()));
            
        }
        
        
        
            public function createAction(Request $request)
        {   
        
                $user = new User();
        
                $form = $this->createCreateForm($user);
        
                $form->handleRequest($request);
        
        
                if($form->isValid())
        {
                $password = $form->get('password')->getData();
            
                $passwordConstraint = new Assert\NotBlank();
                $errorList = $this->get('validator')->validate($password, $passwordConstraint);
            
                if(count($errorList) == 0)
            
                    
        {
                    
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $password);
                 
                
                $user->setPassword($encoded);
                
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $successMessage = $this->get('translator')->trans('El Usuario se creo satisactoriamente.');
                $this->addFlash('mensaje', $successMessage);
                
//                $successMessage = $this->get('translator')->trans('The user has been created.');
//                $this->addFlash('mensaje', $successMessage);
                
                return $this->redirectToRoute('oio_user_index');                
            }
            
            else
            
            {
                $errorMessage = new FormError($errorList[0]->getMessage());
             
                $form->get('password')->addError($errorMessage);
            }
        }
        
        
        return $this->render('oioUserBundle:User:add.html.twig', array('form' => $form->createView()));
        
        
        }
            
            
            // funciones privadas
            
                private function createCreateForm(User $entity)
        {
        
                    
                 $form = $this->createForm(new UserType(), $entity, array(
                'action' => $this->generateUrl('oio_user_create'),
                'method' => 'POST'
        ));
        
        return $form;
        
        
        
        }
            
         
        
        }
                
        
        