<?php

namespace Drupal\ranking_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ranking_field' widget.
 *
 * @FieldWidget (
 *   id = "ranking_field",
 *   label = @Translation("Ranking Field"),
 *   field_types = {
 *     "ranking_field"
 *   }
 * )
 */
class RankingWidget extends WidgetBase
{
    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items,$delta,array $element,array &$form,FormStateInterface $form_state ){

        $element['number_of_raters'] = [
            '#type' => 'number',
            '#title' => t('The Number of raters'),
            '#default_value' => isset($items[$delta]->number_of_raters) ? $items[$delta]->number_of_raters : 1,
            '#size' => 3,
            '#disabled' => TRUE,
        ];
        $element['number_of_stars'] = [
            '#type' => 'number',
            '#title' => t('The number of stars'),
            '#default_value' => isset($items[$delta]->number_of_stars) ? $items[$delta]->number_of_stars : 1,
            '#size' => 3,
            '#disabled' => TRUE,
        ];

        if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
            $element += [
                '#type' => 'fieldset',
                '#attributes' => ['class' => ['container-inline']],
            ];
        }

        return $element;
    }
}
