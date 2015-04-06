<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Controller;

use Hj\Form\FactoryCreator;
use Hj\Form\UploadBuilder;
use Hj\Twig;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

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
     * @var Twig
     */
    private $twig;

    /**
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function index()
    {
        $factoryCreator = new FactoryCreator($this->twig, new CsrfTokenManager());

        $factory = $factoryCreator->createFactory();

        $builder = $factory->createBuilder();

        $uploadFormBuilder = new UploadBuilder($builder);

        $form = $uploadFormBuilder->build();

        $twigEnvironment = $this->twig->getEnvironment();

        return $twigEnvironment->render(
            self::INDEX_VIEW,
            array(
                'message' => 'Hello',
                'form' => $form->createView(),
            )
        );
    }
}