<template>
    <div class="p-3">
        <select v-model="currentLocal"  class="w-full form-control form-select"
                v-on:change="changeLocal">
            <option v-for="(value, key) in locals" :value="key">
                {{ value }}
            </option>
        </select>
    </div>
</template>

<script>

    import {
        Minimum
    } from 'laravel-nova'

export default {

    data: function () {
        return {
            currentLocal: window.config.currentLocal,
            locals: window.config.locals
        }
    },
    methods: {
        changeLocal() {
            window.location = this.replaceUrlParam(window.location.href, 'lang', this.currentLocal);
        },

        async initializeComponent() {
            await this.getCurrentLocal()
        },

        getLocals() {
            return Minimum(
                Nova.request().get('/nova-vendor/multilingual-nova/locals')
            )
                .then(({ data }) => {
                    this.locals = data
                })
                .catch(error => {

                })
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


        replaceUrlParam(url, paramName, paramValue)
        {
            if (paramValue == null) {
                paramValue = '';
            }
            var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
            if (url.search(pattern)>=0) {
                return url.replace(pattern,'$1' + paramValue + '$2');
            }
            url = url.replace(/[?#]$/,'');
            return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
        }

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
