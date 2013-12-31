var App = window.App = Ember.Application.create({
    rootElement: '#character',
    LOG_TRANSITIONS: true
});

/* Order and include as you please. */
require('helpers');
require('controllers/*');
require('controllers/Character/*');
require('controllers/Characters/*');
require('store');
require('models/*');
require('routes/*');
require('routes/Character/*');
require('routes/Characters/*');
require('views/*');
require('router');
