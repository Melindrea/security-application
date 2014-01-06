App.CharactersEditRoute = Ember.Route.extend({
    model: function (params) {
        console.log(params);
        return this.store.find('character', params.character_id);
    },
    // in this case (the create route), we can reuse the character/edit template
    // associated with the charactersCreateController
    renderTemplate: function () {
        this.render('characters.create', {
            controller: 'characterEdit'
        });
    }
});
