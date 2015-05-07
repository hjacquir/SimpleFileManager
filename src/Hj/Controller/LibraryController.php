<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Controller;

use Hj\Form\FactoryCreator;
use Hj\Form\UploadBuilder;
use Hj\Twig;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class LibraryController
 * @package Hj\Controller
 *
 * @todo refactor and use dependency injection
 */
class LibraryController
{
    const INDEX_VIEW = 'index.html.twig';

    /**
     * @return Response
     */
    public function indexAction()
    {
        $twig = new Twig(new Twig_Loader_Filesystem(), new Twig_Environment());

        $factoryCreator = new FactoryCreator($twig, new CsrfTokenManager());

        $factory = $factoryCreator->createFactory();

        $builder = $factory->createBuilder();

        $uploadFormBuilder = new UploadBuilder($builder);

        $form = $uploadFormBuilder->build();

        $twigEnvironment = $twig->getEnvironment();

        $content = $twigEnvironment->render(
            self::INDEX_VIEW,
            array(
                'message' => 'Welcome',
                'form' => $form->createView(),
            )
        );

        return new Response($content);
    }
}