App.Router = Ember.Router.extend({
  // location: 'none'
});

App.Router.map(function () {
    this.resource('characters', function () {
        this.resource('character', { path:'/:character_id' }, function () {
            this.route('edit');
        });
        this.route('create');
    });
});
