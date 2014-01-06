App.TraitsSingleComponent = Ember.Component.extend({
    tagName: 'dd',
    value: 0,
    minValue: 0,
    maxValue: 5,
    mayFavor: true,
    values: function () {
        var values = [];
        for (var i = this.get('minValue'); i <= this.get('maxValue'); i++) {
            values.push(i);
        }

        return values;
    }.property('minValue', 'maxValue')
});
