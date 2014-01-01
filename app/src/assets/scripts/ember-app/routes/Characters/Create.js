App.CharactersCreateRoute = Ember.Route.extend({
    model: function () {
        // the model for this route is a new empty Ember.Object
        // return Em.Object.create({});
        return this.store.find('character', 2);
    }
});
