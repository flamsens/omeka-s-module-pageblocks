<?php
namespace PageBlocks\Site\BlockLayout;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocks\Form\MediaDetailsForm;

class MediaDetails extends AbstractBlockLayout
{

    protected ServiceLocatorInterface $formElementManager;
    
    public function __construct(ServiceLocatorInterface $formElementManager)
    {
        $this->formElementManager = $formElementManager;
    }
    
    public function getLabel(): string
    {
        return 'Media embed + details'; // @translate
    }
    
    public function prepareForm(PhpRenderer $view): void
    {
        $view->headScript()->appendFile($view->assetUrl('js/media-details.js', 'PageBlocks'));
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ): string
    {
        $form = $this->formElementManager->get(MediaDetailsForm::class);
            
        if ($block && $block->data()) {
            $form->populateValues([
                'o:block[__blockIndex__][o:data][show_heading]' => $block->dataValue('show_heading'),
                'o:block[__blockIndex__][o:data][properties]' => $block->dataValue('properties')
            ]);
        }
        
        $html = $view->blockAttachmentsForm($block);
        $html .= '<a href="#" class="collapse" aria-label="collapse"><h4>' . $view->translate('Options') . '</h4></a>';
        $html .= '<div class="collapsible">';
        $html .= $view->formCollection($form);
        $html .= '</div>';
        
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block): \Laminas\View\Helper\Partial|string
    {
        return $view->partial('common/block-layout/media-details', [
            'attachments' => $block->attachments(),
            'showHeading' => $block->dataValue('show_heading'),
            'properties' => $block->dataValue('properties')
        ]);
    }
}
