<?php
namespace PageBlocks\Form;

use BlockPlus\Form\Element\TemplateSelect;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class FourColumnForm extends Fieldset
{
    public function init()
    {
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][html1]',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'First column' // @translate
            ],
            'attributes' => [
                'class' => 'block-html full wysiwyg wysiwyg--auto-height'
            ]
        ]);
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][html2]',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Second column' // @translate
            ],
            'attributes' => [
                'class' => 'block-html full wysiwyg wysiwyg--auto-height'
            ]
        ]);
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][html3]',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Third column' // @translate
            ],
            'attributes' => [
                'class' => 'block-html full wysiwyg wysiwyg--auto-height'
            ]
        ]);
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][html4]',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Fourth column' // @translate
            ],
            'attributes' => [
                'class' => 'block-html full wysiwyg wysiwyg--auto-height'
            ]
        ]);

        // styling
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][divclass]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Container Class', // @translate
                'info' => 'Optional CSS class for styling HTML.', // @translate
            ],
        ]);
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][template]',
            'type' => TemplateSelect::class,
            'options' => [
                'label' => 'Template to display', // @translate
                'info' => 'Templates are in folder "common/block-layout" of the theme and should start with "multi-column".', // @translate
                'template' => 'common/block-layout/multi-column',
            ],
            'attributes' => [
                'class' => 'chosen-select',
            ],
        ]);

        $options = (new Fieldset(
            'options',
            [
                'label' => 'Options' // @translate
            ],
        ))
        ->setAttributes(['class' => 'collapsible'])
        ->add([
            'name' => 'o:block[__blockIndex__][o:data][col1class]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'First column class', // @translate
                'info' => 'Optional CSS class for styling HTML.', // @translate
            ],
        ])
        ->add([
            'name' => 'o:block[__blockIndex__][o:data][col2class]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Second column class', // @translate
                'info' => 'Optional CSS class for styling HTML.', // @translate
            ],
        ])
        ->add([
            'name' => 'o:block[__blockIndex__][o:data][col3class]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Third column class', // @translate
                'info' => 'Optional CSS class for styling HTML.', // @translate
            ],
        ])
        ->add([
            'name' => 'o:block[__blockIndex__][o:data][col4class]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Fourth column class', // @translate
                'info' => 'Optional CSS class for styling HTML.', // @translate
            ],
        ]);

        $this->add($options);
    }
}