App.Character = DS.Model.extend({
    name: DS.attr('string'),
    characterType: DS.attr('string'), // Solar, Lunar, etc
    type: DS.attr('string'), // Caste, Archetype, etc
    subtype: DS.attr('string'), // Profession, Heritage, etc
    age: DS.attr('string'), // Age span
    concept: DS.attr('string'),
    motivation: DS.attr('string'),
    description: DS.attr('string'),
    creationDate: DS.attr('string'),
    backstory: DS.attr('string'),

    // Computed properties
    typeLabel: function () {
        var characterType = this.get('characterType');
        if (characterType === 'Heroic Mortal') {
            return 'Archetype';
        } else if (['Solar', 'Lunar', 'Sidereal'].indexOf(characterType) > -1) {
            return 'Caste';
        } else {
            return '<choose a type>';
        }
    }.property('characterType'),
    subtypeLabel: function () {
        var characterType = this.get('characterType');
        if (characterType === 'Heroic Mortal') {
            return 'Profession';
        }

        return false;
    }.property('characterType')
});

App.Character.FIXTURES = [{
    id: 1,
    name: 'Spear-Storm Falcon',
    characterType: 'Solar',
    subtype: 'Zenith',
    concept: 'Priestess of War',
    creationDate: '2012-07-09 14:23:07',
    backstory: 'Falcon has a **backstory**, which can be *read*'
}, {
    id: 2,
    name: 'Joyous Saga',
    characterType: 'Heroic Mortal',
    age: 'Adult',
    type: 'Priest',
    subtype: 'Mendicant',
    concept: 'Favoured priestess of Luna',
    motivation: 'Some motivation or another',
    description: 'A description with *markdown*',
    creationDate: '2012-07-09 14:23:07',
    backstory: 'Saga has a **backstory**, which can be *read*'
}];
