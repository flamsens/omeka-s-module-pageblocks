<?php
namespace PageBlocks\Site\BlockLayout;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocks\Form\AnchorForm;

class Anchor extends AbstractBlockLayout
{
    protected ServiceLocatorInterface $formElementManager;
    
    public function __construct(ServiceLocatorInterface $formElementManager)
    {
        $this->formElementManager = $formElementManager;
    }
    
    public function getLabel(): string
    {
        return 'Anchor'; // @translate
    }
    
    public function prepareForm(PhpRenderer $view): void
    {
        $view->headScript()->appendFile($view->assetUrl('js/jquery.charReplacer.js', 'PageBlocks'));
    }

    public function form(
        PhpRenderer $view,
        SiteRepresentation $site,
        SitePageRepresentation $page = null,
        SitePageBlockRepresentation $block = null
    ) {        
        $form = $this->formElementManager->get(AnchorForm::class);

        $anchor_id = '';
        if ($block && $block->data()) {
            $anchor_id = $block->dataValue('anchor_id');

            $form->populateValues([
                'o:block[__blockIndex__][o:data][anchor_id]' => $anchor_id,
            ]);
        }

        $output = $view->formCollection($form);
        $output .= "<a name=\"{$anchor_id}\" id=\"{$anchor_id}\"></a>";

        return $output;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block): \Laminas\View\Helper\Partial|string
    {
        return $view->partial('common/block-layout/anchor', [
            'anchor_id' => $block->dataValue('anchor_id')
        ]);
    }
}