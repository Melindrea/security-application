App.Character = DS.Model.extend({
  name         : DS.attr(),
  type         : DS.attr(), // Solar, Lunar, etc
  subtype      : DS.attr(), // Caste, etc
  concept      : DS.attr(),
  creationDate : DS.attr(),
  backstory    : DS.attr()
});

App.Character.FIXTURES = [{
    id: 1,
    name: 'Spear-Storm Falcon',
    type: 'Solar',
    subtype: 'Zenith',
    concept: 'Priestess of War',
    creationDate: '2012-07-09 14:23:07',
    backstory: 'Falcon has a **backstory**, which can be *read*'
}, {
    id: 2,
    name: 'Joyous Saga',
    type: 'Heroic Mortal',
    subtype: null,
    concept: 'Favoured priestess of Luna',
    creationDate: '2012-07-09 14:23:07',
    backstory: 'Saga has a **backstory**, which can be *read*'
}];
