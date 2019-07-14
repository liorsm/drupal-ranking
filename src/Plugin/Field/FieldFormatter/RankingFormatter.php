<?php
/**
 * @file
 * Contains \Drupal\dicefield\Plugin\Field\FieldFormatter\DiceFormatter.
 */

namespace Drupal\ranking_field\Plugin\Field\FieldFormatter;

use Drupal;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'ranking' formatter.
 *
 * @FieldFormatter (
 *   id = "ranking_field",
 *   label = @Translation("Ranking Field"),
 *   field_types = {
 *     "ranking_field"
 *   }
 * )
 */
class RankingFormatter extends FormatterBase
{
    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $elements = [];
        //$fieldSettings = $this->getFieldSettings();

        $fieldName = $this->fieldDefinition->getName();
        $node = Drupal::routeMatch()->getParameter('node');
        foreach ($items as $delta => $item) {
            $elements[$delta] = [
                '#theme' => 'ranking_field',
                '#data' => [
                    'average' => $item->number_of_stars / $item->number_of_raters,
                    'field' => $fieldName,
                    //'icon' => $fieldSettings ?? $fieldSettings['default_font'],
                    //'color' => $fieldSettings ?? $fieldSettings['default_color'],
                    'nid' => isset($node) ? $node->id() : NULL,
                ],
                '#attached' => [
                    'library' => ['ranking_field/ranking-field-lib'],
                ],

            ];
        }

        return $elements;
    }

}
