<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Form;

define('VENDOR_DIR', realpath(__DIR__ . '/../../../vendor'));
define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form/Symfony/Component/Form');
define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator/Symfony/Component/Validator');
define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');

use Hj\Twig;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;

/**
 * Class FactoryCreator
 * @package Hj\Form
 */
class FactoryCreator
{
    const LOCALE = 'fr';

    /**
     * @var \Symfony\Component\Security\Csrf\CsrfTokenManager
     */
    private $csrfTokenManager;

    /**
     * @var FormBuilderInterface
     */
    private $formBuilder;

    /**
     * @var Twig
     */
    private $twigEnvironment;

    /**
     * @param \Twig_Environment $twigEnvironment
     * @param CsrfTokenManager $csrfTokenManager
     */
    public function __construct(\Twig_Environment $twigEnvironment, CsrfTokenManager $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->twigEnvironment = $twigEnvironment;

        $this->configureTwigEnvironment();
        $this->configureFormBuilder();
    }

    /**
     * Create a form factory
     *
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function createFactory()
    {
        return $this->formBuilder->getFormFactory();
    }

    private function configureTwigEnvironment()
    {
        $translator = new Translator(self::LOCALE);
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource(
            'xlf',
            VENDOR_FORM_DIR . '/Resources/translations/validators.fr.xlf',
            self::LOCALE,
            'validators'
        );
        $translator->addResource(
            'xlf',
            VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.fr.xlf',
            self::LOCALE,
            'validators'
        );

        $formEngine = new TwigRendererEngine(array(DEFAULT_FORM_THEME));
        $formEngine->setEnvironment($this->twigEnvironment);

        $this->twigEnvironment->addExtension(new TranslationExtension($translator));
        $this->twigEnvironment->addExtension(new FormExtension(new TwigRenderer($formEngine, $this->csrfTokenManager)));
    }

    private function configureFormBuilder()
    {
        $validator = Validation::createValidator();

        $this->formBuilder = Forms::createFormFactoryBuilder();
        $this->formBuilder->addExtension(new CsrfExtension($this->csrfTokenManager));
        $this->formBuilder->addExtension(new ValidatorExtension($validator));
        $this->formBuilder->addExtension(new HttpFoundationExtension());
    }
}