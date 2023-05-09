<?php
namespace PageBlocks\Site\BlockLayout;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Laminas\View\Renderer\PhpRenderer;
use PageBlocks\Form\MediaSingleForm;

class MediaSingle extends AbstractBlockLayout
{

    protected ServiceLocatorInterface $formElementManager;
    
    public function __construct(ServiceLocatorInterface $formElementManager)
    {
        $this->formElementManager = $formElementManager;
    }
    
    public function getLabel(): string
    {
        return 'Media + single column'; // @translate
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ): string
    {
        $form = $this->formElementManager->get(MediaSingleForm::class);
            
        if ($block && $block->data()) {
            $form->populateValues([
                'o:block[__blockIndex__][o:data][html]' => $block->dataValue('html')
            ]);
        }
        
        $html = $view->blockAttachmentsForm($block);
        $html .= '<a href="#" class="collapse" aria-label="collapse"><h4>' . $view->translate('Content') . '</h4></a>';
        $html .= '<div class="collapsible">';
        $html .= $view->formCollection($form);
        $html .= '</div>';
        
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block): \Laminas\View\Helper\Partial|string
    {
        return $view->partial('common/block-layout/media-single', [
            'html' => $block->dataValue('html'),
            'attachments' => $block->attachments()
        ]);
    }
}
