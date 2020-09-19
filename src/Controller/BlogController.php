<?php


namespace App\Controller;


use App\Service\Greeting;
use App\Service\VeryBadDesign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{
    /**
     * @var Greeting
     */
    private $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
        //$this->veryBadDesign = $veryBadDesign;
    }

    /**
     * @Route("/{name}", name="blog_index")
     */
    public function index(string $name){
        $this->get('miservicio.greeting');
        return $this->render('base.html.twig',
            ['message'=>"el parametro es: ". $name]);
    }
}