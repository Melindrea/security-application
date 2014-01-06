App.CharacterController = Ember.ObjectController.extend({
    deleteMode: false,
    actions: {
        edit: function () {
            this.transitionToRoute('characters.edit', this.get('model'));
        },
        delete: function () {
            this.toggleProperty('deleteMode');
        },
        cancelDelete: function(){
            // set deleteMode back to false
            this.set('deleteMode', false);
        },
        confirmDelete: function () {
            this.get('model').deleteRecord();
            this.get('model').save();
            // then transition to the users route
            this.transitionToRoute('characters');
        }
    }
});
