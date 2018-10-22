import React from 'react';
import ReactDOM from 'react-dom';
import Display from './Display';

(function ($, Drupal) {

  Drupal.behaviors.moderation_state_columns_view_display = {
    attach: function (context, settings) {
      if (!settings.moderationStateColumns) {
        return;
      }

      Object.keys(settings.moderationStateColumns).forEach(domId => {
        $(`.js-view-dom-id-${domId} .moderation-state-columns--component-container`, context)
          .each(function () {
            const { entities, states } = settings.moderationStateColumns[domId];
            ReactDOM.render(<Display entities={entities} states={states} />, this);
          });
      });
    }
  };

})(jQuery, Drupal);
