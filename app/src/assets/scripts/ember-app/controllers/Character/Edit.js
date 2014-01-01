App.CharacterEditRoute = Ember.Route.extend({
    model: function () {
        return this.modelFor('character');
    },
    // in this case (the create route), we can reuse the character/edit template
    // associated with the charactersCreateController
    renderTemplate: function () {
        this.render('characters.create', {
            controller: 'characterEdit'
        });
    }
});
