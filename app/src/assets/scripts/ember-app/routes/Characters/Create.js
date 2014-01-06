App.CharactersCreateRoute = Ember.Route.extend({
    model: function () {
        // the model for this route is a new empty Ember.Object
        // return Em.Object.create(values);
        // return this.store.find('character', 2);
        var traits = this.store.createRecord('traits', {
            strength: { value: 2, favored: false },
            dexterity: { value: 2, favored: false },
            stamina: { value: 2, favored: false },
            charisma: { value: 2, favored: false },
            manipulation: { value: 2, favored: false },
            appearance: { value: 2, favored: false },
            perception: { value: 2, favored: false },
            intelligence: { value: 2, favored: false },
            wits: { value: 2, favored: false }
        }),
        character = { traits: traits};
        return this.store.createRecord('character', character);
    }
});
