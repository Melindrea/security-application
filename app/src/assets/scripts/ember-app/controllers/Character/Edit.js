App.CharacterEditRoute = Ember.Route.extend({
    model: function(){
        return this.modelFor('character');
    }
});
