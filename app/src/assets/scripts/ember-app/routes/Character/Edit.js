App.CharacterEditController = Ember.ObjectController.extend({
    actions: {
        save: function () {
            var character = this.get('model');
            // this will tell Ember-Data to save/persist the new record
            character.save();
            // then transition to the current character
            this.transitionToRoute('character', character);
        }
    }
});
