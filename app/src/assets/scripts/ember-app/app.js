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

App.abilities = {
    'Craft': {
        'air': 'Air',
        'earth': 'Earth'
    },
    'Solar': {
        'Dawn': {
            'archery': 'Archery',
            'martial_arts': 'Martial Arts',
            'melee': 'Melee',
            'thrown': 'Thrown',
            'war': 'War'
        },
        'Zenith': {
            'integrity': 'Integrity',
            'performance': 'Performance',
            'presence': 'Presence',
            'resistance': 'Resistance',
            'survival': 'Survival'
        },
        'Twilight': {
            'craft': 'Craft',
            'investigation': 'Investigation',
            'lore': 'Lore',
            'medicine': 'Medicine',
            'occult': 'Occult'
        },
        'Night': {
            'athletics': 'Athletics',
            'awareness': 'Awareness',
            'dodge': 'Dodge',
            'larceny': 'Larceny',
            'stealth': 'Stealth'
        },
        'Eclipse': {
            'bureaucracy': 'Bureacracy',
            'linguistics': 'Linguistics',
            'ride': 'Ride',
            'sail': 'Sail',
            'socialize': 'Socialize'
        }
    }
}

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
