<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;

    use App\Entity\Article;
    # add routes here directly
    use Symfony\Component\Routing\Annotation\Route;

    # restrict certain methods such as post etc.
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    # render twig templates
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class ArticleController extends Controller {
        /**
         * @Route("/", name="article_list")
         * @Method({"GET"})
         */
        public function index() {

            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
            return $this->render('articles/index.html.twig',
                array("articles" => $articles));
        }

        /**
         * @Route("/article/{id}", name="article_show")
         */
        public function getArticle($id){
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
            return $this->render('articles/show.html.twig', array('article' => $article));
        }

    }

?>