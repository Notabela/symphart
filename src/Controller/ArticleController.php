<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;

    # add routes here directly
    use Symfony\Component\Routing\Annotation\Route;

    # restrict certain methods such as post etc.
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    # render twig templates
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class ArticleController extends Controller {
        /**
         * @Route("/")
         * @Method({"GET"})
         */
        public function index() {

            $articles = ['Article 1', 'Article 2'];
            return $this->render('articles/index.html.twig',
                array("articles" => $articles));
        }
    }

?>