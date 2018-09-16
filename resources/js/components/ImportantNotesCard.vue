<template>
    <loading-view :loading="initialLoading">
        <card class="relative px-6 py-4">
            <div class="flex mb-4">
                <h3 class="mr-3 text-base text-80 font-bold">Important Notes</h3>
            </div>

            <div class="border-t border-40 text-center py-8" v-if="! initialLoading && notesCount == 0">
                <p>No important notes were found.</p>
            </div>

            <div v-else>
                <div class="flex border-t border-40" v-for="note in notes">
                    <div class="w-1/4 py-4">
                        {{ note.owner.name }}
                        <span class="block text-sm mt-2 text-70">
                            {{ note.created_at }}
                        </span>
                        <span class="block mt-4">
                            <router-link :to="{
                                                name: 'detail',
                                                params: {
                                                    resourceName: note.parent.resource_name,
                                                    resourceId: note.parent.id
                                                }
                                            }" class="no-underline dim text-primary font-bold">
                                                {{ note.parent.name }}
                            </router-link>
                        </span>
                    </div>
                    <div class="w-3/4 py-4 flex justify-between">
                        <span v-html="note.body"></span>
                        <button type="button" class="btn btn-default btn-danger">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
            
        </card>
    </loading-view>
</template>

<script>
    export default {
        props: ['card'],

        data() {
            return {
                initialLoading: true,
                notesCount: 0,
                notes: []
            }
        },

        mounted() {
            this.loadNotes();
        },

        methods: {

            loadNotes() {
                Nova.request().get('/nova-vendor/nova-notes/important')
                    .then(response => {
                        this.notes = response.data;
                        this.notesCount = this.notes.length;
                        this.initialLoading = false;
                    })
            }
        }
    }
</script>