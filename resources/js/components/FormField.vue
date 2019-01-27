<template>
    <default-field :field="field">
        <template slot="field">
            <select :id="field.name" v-model="currentLocal"  class="w-full form-control form-select" :class="errorClasses" :placeholder="field.name" v-on:change="changeLocal">
                <option v-for="(value, key) in locals" :value="key">{{ value }}</option>
            </select>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

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
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.currentLocal || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
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
    }
}
</script>
