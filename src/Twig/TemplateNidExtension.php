<?php

namespace Drupal\template_nid\Twig;


/**
 * Class TemplateNidExtension
 * Print related nodes
 * @package Drupal\template_nid\Twig
 */
class TemplateNidExtension extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'template_nid';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('template_nid', [$this, 'templateNid'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function templateNId($templateName) {
        $query = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('field_template.value', $templateName)
            ->range(0, 1)
        ;

        $result = $query->execute();

        if( !empty($result) ) {
            return current($result);
        }

        return 0;
    }
}