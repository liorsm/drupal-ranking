<?php

namespace Drupal\ranking_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'ranking' field type.
 *
 * @FieldType (
 *   id = "ranking_field",
 *   label = @Translation("Ranking Field"),
 *   description = @Translation("Ranking Field"),
 *   default_widget = "ranking_field",
 *   default_formatter = "ranking_field"
 * )
 */
class Ranking extends FieldItemBase {

    const DEFAULT_FONT_CLASS = 'fa fa-star';
    const DEFAULT_COLOR = 'red';
    /**
     * {@inheritdoc}
     */
    public static function defaultFieldSettings() {
        return [
                'default_font' => self::DEFAULT_FONT_CLASS,
                'default_color' => self::DEFAULT_COLOR,
            ] + parent::defaultFieldSettings();
    }


  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'number_of_raters' => [
          'type' => 'int',
        ],
        'number_of_stars' => [
          'type' => 'int',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value1 = $this->get('number_of_raters')->getValue();
    $value2 = $this->get('number_of_stars')->getValue();
    return empty($value1) && empty($value2);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['number_of_raters'] = DataDefinition::create('integer')
      ->setLabel(t('The Number of raters'))
        ->setReadOnly(true)
      ->setDescription(t('The Number of raters'));

    $properties['number_of_stars'] = DataDefinition::create('integer')
      ->setLabel(t('The number of stars'))
        ->setReadOnly(true)
      ->setDescription(t('The number of stars'));

    return $properties;
  }



    /**
     * {@inheritdoc}
     */
/*   public function fieldSettingsForm(array $form, FormStateInterface $form_state) {

        $element = [];
        // The key of the element should be the setting name.
        $element['icon'] = [
            '#title' => $this->t('icon'),
            '#type' => 'select',
            '#options' => [
                'fa fa-heart' => 'fa fa-heart',
                'fa fa-money' => 'fa fa-money',
                'fa fa-pie-chart' => 'fa fa-pie-chart',
                'fa fa-sign-language' => 'fa fa-sign-language',
                'fa fa-futbol-o' => 'fa fa-futbol-o',
                'fa fa-thumbs-up' => 'fa fa-thumbs-up',
                'fa fa-thumbs-o-up' => 'fa fa-thumbs-o-up',
                'fa fa-sun-o' => 'fa fa-sun-o',
                'fa fa-star' => 'fa fa-star',
                'fa fa-star-o' => 'fa fa-star-o',
            ],
            '#default_value' => $this->getSetting('default_font'),
        ];

        $element['color'] = [
            '#title' => $this->t('color'),
            '#type' => 'select',
            '#options' => [
                'red' => 'red',
                'orange' => 'orange',
                'yellow' => 'yellow',
            ],
            '#default_value' => $this->getSetting('default_color'),
        ];

        return $element;
    }
*/
}
