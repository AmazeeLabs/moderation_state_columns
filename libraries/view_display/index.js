import React from 'react';
import ReactDOM from 'react-dom';
import Display from './Display';

(function ($, Drupal) {

  Drupal.behaviors.moderation_state_columns_view_display = {
    attach: function (context, settings) {
      $('.moderation-state-columns--component-container .moderation-state-columns--json-content', context).each(function () {
        const { entities, states } = JSON.parse($(this).text());
        ReactDOM.render(<Display entities={entities} states={states} />, $(this).parent().get(0));
        $(this).remove();
      });
    }
  };

})(jQuery, Drupal);
