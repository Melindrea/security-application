App.CharactersController = Ember.ArrayController.extend({
    sortProperties: ['name'],
    sortAscending: true, // false = descending

    charactersCount: function(){
        return this.get('model.length');
    }.property('@each')
});
