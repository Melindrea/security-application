App.CharactersCreateController = Ember.ObjectController.extend({
    actions: {
        save: function () {
            // just before saving, we set the creationDate
            this.get('model').set('creationDate', new Date());

            // create a record and save it to the store
            // var newCharacter = this.store.createRecord('character', this.get('model'));
            // newCharacter.save();

            // redirects to the character itself
            this.transitionToRoute('character', newCharacter);
        },
        addIntimacy: function () {
            var newIntimacy = this.store.createRecord('intimacy', {});
            this.get('model').get('intimacies').pushObject(newIntimacy);
        },
        removeIntimacy: function (intimacy) {
            intimacy.deleteRecord();
        }
    },
    types: function () {
        var characterType = this.get('model').get('characterType');
        if (App.characterTypes.indexOf(characterType) === -1) {
            return ['<choose type>'];
        }

        return App.types[characterType];
    }.property('model.characterType')
});
