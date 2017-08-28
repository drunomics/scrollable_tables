<?php

namespace Drupal\scrollable_tables\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to make tables scrollable.
 *
 * @Filter(
 *   id = "scrollable_tables",
 *   title = @Translation("Make tables scrollable"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE
 * )
 */
class ScrollableTables extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);
    if (strpos($text, '<table') !== FALSE) {
      $text = str_replace('<table', '<div class="table-wrapper--scrollable"><table', str_replace('</table>', '</table></div>', $text));
      $result->setProcessedText($text);
      $result->addAttachments([
        'library' => [
          'scrollable_tables/table-wrapper',
        ],
      ]);
    }

    return $result;
  }

}
