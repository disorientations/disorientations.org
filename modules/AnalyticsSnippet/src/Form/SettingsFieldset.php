<?php
namespace AnalyticsSnippet\Form;

use Zend\Form\Element;
use Zend\Form\Fieldset;

class SettingsFieldset extends Fieldset
{
    protected $label = 'Analytics Snippet'; // @translate

    public function init()
    {
        $this
            ->add([
                'name' => 'analyticssnippet_inline_public',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Code to append to public pages', // @translate
                    'info' => 'Don’t forget to add the tags <script> and </script> for javascript.', // @translate
                ],
                'attributes' => [
                    'id' => 'analyticssnippet-inline-public',
                    'rows' => 5,
                    'placeholder' => '<script>
console.log("Analytics Snippet ready!");
</script>',
                ],
            ])
            ->add([
                'name' => 'analyticssnippet_inline_admin',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Code to append to admin pages', // @translate
                    'info' => 'Don’t forget to add the tags <script> and </script> for javascript.', // @translate
                ],
                'attributes' => [
                    'id' => 'analyticssnippet-inline-admin',
                    'rows' => 5,
                    'placeholder' => '<script>
console.log("Analytics Snippet ready for admin!");
</script>',
                ],
            ])
        ;
    }
}
