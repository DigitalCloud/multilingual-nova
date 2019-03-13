<template>
    <div>
        <heading class="mb-6">Nova Language Tool</heading>

        <card class="flex  p-3">
            <div class="flex border-b border-40 w-full" >
                <div class="w-1/4 py-6 px-8">
                    <label class="inline-block text-80 pt-2 leading-tight" for="language">{{__('Select Language')}}</label>
                </div>
                <div class="py-6 px-8 w-1/2">
                    <select v-model="currentLocal" id="language"  dusk="language"  :placeholder="__('Select Language')" class="w-full form-control form-select">
                        <option v-for="(value, key) in locals" :value="key">
                            {{ value }}
                        </option>
                    </select>
                    <div class="help-text help-text mt-2">  </div>
                </div>
                <div class="py-6 px-2 w-1/4">
                    <button type="button" class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3" dusk="change-language-button" @click="changeLocal">
                        <span class="">{{__('Change Language')}}</span>
                    </button>
                </div>
            </div>
        </card>
    </div>
</template>

<script>

    import {
        Minimum
    } from 'laravel-nova'

export default {

    data: function () {
        return {
            initialLoading: true,
            currentLocal: window.config.currentLocal,
            locals: window.config.locals
        }
    },
    methods: {
        changeLocal() {
            const fd = new FormData();
            fd.append('lang', this.currentLocal);
            axios.post('/nova-vendor/multilingual-nova/current-local', fd )
                .then(({ data }) => {
                    console.log(data);
                    // TODO display a successful message
                    window.location = Nova.config.base + "/nova-language-tool?lang=" + this.currentLocal;
                })
                .catch(error => {
                    //TODO display an error message
                    console.log(error)
                });

        },

        async initializeComponent() {
            await this.getCurrentLocal()

            this.initialLoading = false
        },

        getCurrentLocal() {
            return Minimum(
                Nova.request().get('/nova-vendor/multilingual-nova/current-local')
            )
                .then(({ data }) => {
                    this.currentLocal = data
                    this.loading = false
                })
                .catch(error => {

                })
        },

    },
    created() {

    },
    mounted() {
        // this.initializeComponent()
    },
}
</script>

<style>
/* Scoped Styles */
</style>
