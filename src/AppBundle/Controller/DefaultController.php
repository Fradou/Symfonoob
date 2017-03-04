<?php

namespace AppBundle\Controller;

use AppBundle\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Article');
        $articles=$repository->getArticleByTag('', 5);
        $tags = ['Dev Web', 'Java', 'Symfony' ];

        return $this->render('default/index.html.twig', array(
            'articles' => $articles,
            'tags' => $tags
        ));
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
