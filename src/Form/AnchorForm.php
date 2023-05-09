<?php
namespace PageBlocks\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class AnchorForm extends Fieldset
{
    public function init()
    {
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][anchor]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Anchor name', // @translate
                'info' => '', // @translate
                'class' => 'anchor'
            ],
            'attributes' => [
                'class' => 'anchor'
            ]
        ]);
    }
}