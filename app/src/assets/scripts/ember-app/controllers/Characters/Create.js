App.CharactersCreateController = Ember.ObjectController.extend({
    actions: {
        save: function () {
            // just before saving, we set the creationDate
            this.get('model').set('creationDate', new Date());

            // create a record and save it to the store
            var newCharacter = this.store.createRecord('character', this.get('model'));
            newCharacter.save();

            // redirects to the character itself
            this.transitionToRoute('character', newUser);
        }
    }
});
