<?php

namespace Drupal\moderation_state_columns\Plugin\views\style;

use Drupal\core\form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\workflows\Entity\Workflow;

/**
 * Renders entities in the columns associated with their moderation state.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "moderation_state_columns",
 *   title = @Translation("Moderation state columns"),
 *   help = @Translation("Renders entities in columns representing their
 *   moderation states."), theme = "views_view_moderation_state_columns",
 *   display_types = { "normal" }
 * )
 */
class ModerationStateColumns extends StylePluginBase {

  /**
   * Does the style plugin for itself support to add fields to its output.
   *
   * @var bool
   */
  protected $usesFields = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['workflow'] = array('default' => '');
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $workflows = ['' => $this->t('- Select -')];
    /** @var Workflow $workflow */
    foreach (Workflow::loadMultiple() as $workflow) {
      $workflows[$workflow->id()] = $workflow->label();
    }

    $form['workflow'] = [
      '#type' => 'select',
      '#required' => TRUE,
      '#title' => $this->t('Workflow'),
      '#description' => $this->t('The workflow to use.'),
      '#options' => $workflows,
      '#default_value' => $this->options['workflow'],
    ];
  }

}
