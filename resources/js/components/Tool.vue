<template>
    <div>
        <loading-card v-if="initialLoading" class="h-12 shadow-none"></loading-card>

        <!-- New Note Form -->
        <div class="flex" v-if="new_note">
            <div class="w-1/4 py-4"></div>
            <div class="w-3/4 py-4">
                <textarea v-model="new_note_body" id="new_note_body" class="w-full form-control form-input form-input-bordered py-3 min-h-textarea" name="note"></textarea>

                <div class="py-4">
                    <button class="ml-auto btn btn-default btn-primary mr-3" @click="storeNote">
                        Save Note
                    </button>
                </div>
            </div>
        </div>
        
        <!-- No Results -->
        <div class="border-t border-40 text-center py-8" v-if="! initialLoading && notesCount == 0">
            <p>No notes have been made for this resource.</p>
        </div>

        <div class="flex border-t border-40" v-for="note in notes">
            <div class="w-1/4 py-4">
                {{ note.owner.name }}
                <span class="block text-sm mt-2 text-70">
                    {{ note.created_at }}
                </span>
                <span v-if="note.important" class="block text-sm text-danger mt-2">
                    Important
                </span>
            </div>
            <div class="w-3/4 py-4">
                <span v-html="note.body"></span>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
		props: ['resourceName', 'resourceId', 'field'],

    	data: () => ({
    		initialLoading: true,
            new_note: true,
    		notesCount: 0,
            new_note_body: '',
            notes: []
    	}),

        mounted() {
            if (! this.field.new_note) {
                this.new_note = false;
            }
        },

    	created() {
    		this.loadNotes();
    	},

        methods: {

            loadNotes() {
                console.log(this.field);
                Nova.request().post('/nova-vendor/nova-notes/notes', {
                    model: this.field.model,
                    id: this.resourceId
                }).then(response => {
                    this.initialLoading = false;
                    this.notes = response.data;
                    this.notesCount = this.notes.length;
                })
            },

            storeNote() {
                if (! this.new_note_body.length) {
                    this.$toasted.show('Please enter a note before saving.', {type: 'error'})
                    return false;
                }

                Nova.request().post('/nova-vendor/nova-notes/new-note', {
                    model: this.field.model,
                    id: this.resourceId,
                    body: this.new_note_body
                }).then(response => {
                    this.$toasted.show('Note has been saved.', {type: 'success'})
                    this.resetNotes();
                }).catch(response => {
                    this.$toasted.show('There was an error saving the note.', {type: 'error'})
                });
            },

            resetNotes() {
                this.new_note_body = '';
                this.loadNotes();
            }
        }
    }
</script>
