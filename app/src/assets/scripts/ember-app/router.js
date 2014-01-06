App.Router = Ember.Router.extend({
  // location: 'none'
});

App.Router.map(function () {
    this.resource('characters', function () {
        this.resource('character', { path:'/:character_id' });
        this.route('edit', {path: '/:character_id/edit'});
        this.route('create');
    });
});
