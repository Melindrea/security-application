var App = window.App = Ember.Application.create({
    rootElement: '#character',
    LOG_TRANSITIONS: true
});

App.characterTypes = ['Solar', 'Lunar', 'Heroic Mortal'];
App.types = {
    'Solar': ['Dawn', 'Zenith', 'Twilight', 'Night', 'Eclipse'],
    'Lunar': ['Full Moon', 'Changing Moon', 'No Moon', 'Uncasted'],
    'Heroic Mortal': ['Warrior', 'Priest', 'Scholar', 'Criminal', 'Diplomat']
};
App.ageSpans = ['Young Adult', 'Adult', 'Middle age', 'Elder'];

/* Order and include as you please. */
require('helpers');
require('components/*');
require('controllers/*');
require('controllers/Character/*');
require('controllers/Characters/*');
require('store');
require('models/*');
require('routes/*');
require('routes/Character/*');
require('routes/Characters/*');
require('views/*');
require('DSTransforms/*');
require('router');
