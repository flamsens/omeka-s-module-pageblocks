<?php
namespace PageBlocks\Site\BlockLayout;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\View\Helper\Partial;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocks\Form\FourColumnForm;

class FourColumn extends AbstractBlockLayout
{
    /**
     * The default partial view script.
     */
    const PARTIAL_NAME = 'common/block-layout/multi-column';

    protected ServiceLocatorInterface $formElementManager;
    
    public function __construct(ServiceLocatorInterface $formElementManager)
    {
        $this->formElementManager = $formElementManager;
    }
    
    public function getLabel(): string
    {
        return 'Four column HTML'; // @translate
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $form = $this->formElementManager->get(FourColumnForm::class);
        $defaultSettings = [];

        $data = $block ? $block->data() + $defaultSettings : $defaultSettings;

        $dataForm = [];
        foreach ($data as $key => $value) {
            $dataForm['o:block[__blockIndex__][o:data][' . $key . ']'] = $value;
        }
        $form->populateValues($dataForm);

        return $view->formCollection($form);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block): Partial|string
    {
        $vars = [
            'columns' => [
                $block->dataValue('html1'),
                $block->dataValue('html2'),
                $block->dataValue('html3'),
                $block->dataValue('html4'),
            ],
            'columnClasses' => [
                $block->dataValue('col1class'),
                $block->dataValue('col2class'),
                $block->dataValue('col3class'),
                $block->dataValue('col4class'),
            ],
            'divclass' => $block->dataValue('divclass')
        ];

        $template = $block->dataValue('template', self::PARTIAL_NAME);
        return $template !== self::PARTIAL_NAME && $view->resolver($template)
            ? $view->partial($template, $vars)
            : $view->partial(self::PARTIAL_NAME, $vars);
    }
}