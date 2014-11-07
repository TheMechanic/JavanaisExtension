<?php

namespace Blog\JavanaisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createInputForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $textToTranslate = $data['inputtext'];
        }

        return $this->render('JavanaisBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'textToTranslate' => isset($textToTranslate) ? $textToTranslate : null
        ));
    }

    private function createInputForm()
    {
        return $this->createFormBuilder()
            ->add('inputtext', 'textarea', array('required' => true))
            ->getForm();
    }
}
