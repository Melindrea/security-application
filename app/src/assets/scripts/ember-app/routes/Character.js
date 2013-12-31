App.CharacterRoute = Ember.Route.extend({
    model: function(params) {
        return this.store.find('character', params.character_id);
    }
});
