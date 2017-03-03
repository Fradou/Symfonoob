<?php

namespace AppBundle\Controller;

use AppBundle\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    public function tagSearchAction(Request $request, $tag){

        if ($request->isXmlHttpRequest()) {

            /**
             * @var $repository ArticleRepository
             */
            $repository = $this->getDoctrine()->getRepository('AppBundle:Article');
            $articles= $repository->getArticleByTag($tag, 5);
            return new JsonResponse(array("data" => json_encode($articles)));

        } else
        {
            throw new HttpException('500', 'Invalid call');
        }
    }
}
