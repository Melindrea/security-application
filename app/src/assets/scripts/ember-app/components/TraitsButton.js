App.TraitsButtonComponent = Ember.Component.extend({
    tagName: 'button',
    classNameBindings:['isFilled'],
    value: 0,
    trait: null,

    // Events
    click: function () {
        this.set('trait', this.get('value'));
    },

    // Properties
    isFilled: function () {
        return (this.get('trait') >= this.get('value'));
    }.property('trait', 'value')
});
