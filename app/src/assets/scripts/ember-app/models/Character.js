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

    // Relationships
    intimacies: DS.hasMany('intimacy', {async: true}),
    traits: DS.belongsTo('traits', {async: true}),

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
    }.property('characterType'),
    hasFavoredAttributes: function () {
        var attributeTypes = ['Lunar'],
        characterType = this.get('characterType');

        return (attributeTypes.indexOf(characterType) > -1);
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
    backstory: 'Saga has a **backstory**, which can be *read*',
    intimacies: [1,2]
}];

App.Traits = DS.Model.extend({
    character: DS.belongsTo('character', {async: true}),
    // These should have a specific type
    // strength: DS.attr('number'),
    // dexterity: DS.attr('number'),
    // stamina: DS.attr('number'),
    // charisma: DS.attr('number'),
    // manipulation: DS.attr('number'),
    // appearance: DS.attr('number'),
    // perception: DS.attr('number'),
    // intelligence: DS.attr('number'),
    // wits: DS.attr('number')
});

App.Traits.FIXTURES = [{
    id: 1,
    character: 2,
    strength: { value: 2, favored: false },
    dexterity: { value: 2, favored: false },
    stamina: { value: 2, favored: false },
    charisma: { value: 2, favored: false },
    manipulation: { value: 2, favored: false },
    appearance: { value: 2, favored: false },
    perception: { value: 2, favored: false },
    intelligence: { value: 2, favored: false },
    wits: { value: 2, favored: false }
}]

App.Intimacy = DS.Model.extend({
    character: DS.belongsTo('character', {async: true}),
    name: DS.attr('string'),
    fullyFormed: DS.attr('boolean', {defaultValue: true}),
    strength: DS.attr('number'),
    context: DS.attr('string')
});

App.Intimacy.FIXTURES = [{
    id: 1,
    name: 'Luna',
    fullyFormed: true,
    strength: 4,
    context: 'Love',
    character: 2
}, {
    id: 2,
    name: 'Wyld-Shattering Wrath',
    fullyFormed: true,
    strength: 4,
    context: 'Love',
    character: 2
}];
