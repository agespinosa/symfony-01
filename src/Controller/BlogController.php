<?php


namespace App\Controller;


use App\Service\Greeting;
use App\Service\VeryBadDesign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends Controller
{

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {

        $this->session = $session;
    }

    /**
     * @Route("/{name}", name="blog_index")
     */
    public function index(string $name){
        return $this->render('blog/index.html.twig',[
            'posts'=> $this->session->get('posts')
        ]);
    }

    /**
     * @Route("/add", name="blog_add")
     */
    public function add(Request $request){
        $posts= $this->session->get('posts');
        $posts[uniqid()]=[
            'title'=> 'A randon tiele '.rand(1,500),
            'text'=> 'Some random text nr '.rand(1,500)
        ];
        $this->session->set('posts', $posts);
    }

    /**
     * @Route("/show/{id}" , name="blog_show")
     */
    public function show(Request $request, int $id){
        $posts= $this->session->get('posts');
        if (!$posts || !isset($posts[$id])){
            throw new NotFoundHttpException('Post no encontrador');
        }
        return $this->render('blog/post.html.twig', [
            'id'=> $id,
            'post'=>$posts[$id]
        ]);
    }
}