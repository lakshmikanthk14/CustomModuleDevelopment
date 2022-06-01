<?php

namespace Drupal\welcome_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block123"),
 *   category = @Translation("Hello World"),
 * )
 */

class welcomeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['hello_block_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => $config['hello_block_name'] ?? '',
    ];
    $form['hello_block_number'] = [
        '#type' => 'number',
        '#title' => $this->t('phone number'),
        '#description' => $this->t('phone number please'),

      ];

     
    return $form;
  }
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['hello_block_name'] = $form_state->getValue('hello_block_name');
  }


  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['hello_block_name'])) {
      $name = $config['hello_block_name'];
    }
    else {
      $name = $this->t('to no one');
    }

    return [
      '#markup' => $this->t('Hello @name!', [
        '@name' => $name,
      ]),
    ];
  }
}
