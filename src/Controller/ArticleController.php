<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use App\Entity\Article;
    # add routes here directly
    use Symfony\Component\Routing\Annotation\Route;

    # restrict certain methods such as post etc.
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    # render twig templates
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;



    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
         * @Route("/article/new", name="new_article")
         * @Method({"GET", "POST"})
         */
        public function newArticle(Request $request) {
            $article = new Article();

            $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $article = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('articles/new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/article/{id}", name="article_show")
         */
        public function getArticle($id){
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
            return $this->render('articles/show.html.twig', array('article' => $article));
        }

        /**
         * @Route("/articles/delete/{id}")
         * @Method({"DELETE"})
         */
        public function deleteArticle(Request $request, $id) {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();

            $response = new Response();
            $response->send();
        }

        /**
         * @Route("/article/edit/{id}", name="edit_article")
         * @Method({"GET", "POST"})
         */
        public function editArticle(Request $request, $id) {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $article = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('articles/new.html.twig', array('form' => $form->createView()));
        }


    }

?>