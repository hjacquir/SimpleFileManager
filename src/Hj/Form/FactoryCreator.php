<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Form;

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
 *
 * @todo fix : refactor, split, rename and use dependency injection
 */
class FactoryCreator
{
    const LOCALE = 'fr';
    const TRANSLATIONS_DOMAIN = 'validators';
    const TRANSLATIONS_VALIDATOR_PATH = '/Resources/translations/validators.fr.xlf';
    const VALIDATORS_FORMAT = 'xlf';
    const DEFAULT_FORM_THEME = 'form_div_layout.html.twig';
    const VENDOR_DIR = '/../../../vendor';
    const SYMFONY_COMPONENT_FORM_DIR = '/symfony/form/Symfony/Component/Form';
    const SYMFONY_COMPONENT_VALIDATOR_DIR = '/symfony/validator/Symfony/Component/Validator';

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
    private $twig;

    /**
     * @var string
     */
    private $vendorFormDirPath;

    /**
     * @var string
     */
    private $vendorValidatorDirPath;

    /**
     * @param \Hj\Twig $twig
     * @param CsrfTokenManager $csrfTokenManager
     */
    public function __construct(Twig $twig, CsrfTokenManager $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->twig = $twig;

        $vendorDirPath = realpath(__DIR__ . self::VENDOR_DIR);

        $this->vendorFormDirPath = $vendorDirPath . self::SYMFONY_COMPONENT_FORM_DIR;
        $this->vendorValidatorDirPath = $vendorDirPath . self::SYMFONY_COMPONENT_VALIDATOR_DIR;

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
        $translator->addLoader(self::VALIDATORS_FORMAT, new XliffFileLoader());
        $translator->addResource(
            self::VALIDATORS_FORMAT,
            $this->vendorFormDirPath . self::TRANSLATIONS_VALIDATOR_PATH,
            self::LOCALE,
            self::TRANSLATIONS_DOMAIN
        );
        $translator->addResource(
            self::VALIDATORS_FORMAT,
            $this->vendorValidatorDirPath . self::TRANSLATIONS_VALIDATOR_PATH,
            self::LOCALE,
            self::TRANSLATIONS_DOMAIN
        );

        $formEngine = new TwigRendererEngine(array(self::DEFAULT_FORM_THEME));

        $twigEnvironment = $this->twig->getEnvironment();

        $formEngine->setEnvironment($twigEnvironment);

        $twigEnvironment->addExtension(new TranslationExtension($translator));
        $twigEnvironment->addExtension(new FormExtension(new TwigRenderer($formEngine, $this->csrfTokenManager)));
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