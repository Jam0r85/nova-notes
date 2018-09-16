Nova.booting((Vue, router) => {
	Vue.component('nova-notes', require('./components/Tool'));
	Vue.component('nova-notes-important', require('./components/ImportantNotesCard'));
})
