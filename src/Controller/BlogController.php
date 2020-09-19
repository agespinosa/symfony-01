<?php


namespace App\Controller;


use App\Service\Greeting;
use App\Service\VeryBadDesign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @var Greeting
     */
    private $greeting;
    /**
     * @var VeryBadDesign
     */
    private $veryBadDesign;

    public function __construct(Greeting $greeting, VeryBadDesign $veryBadDesign)
    {
        $this->greeting = $greeting;
        $this->veryBadDesign = $veryBadDesign;
    }

    /**
     * @Route("/", name="blog_index")
     */
    public function index(Request $request){
        return $this->render('base.html.twig',
            ['message'=>$this->greeting->greet($request->get('name'))]);
    }
}