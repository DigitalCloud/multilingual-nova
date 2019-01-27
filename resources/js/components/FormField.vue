<template>
    <default-field :field="field">
        <template slot="field">
            <div v-if="this.field.value.style=='button' || (this.field.value.style=='mix' && locals.length <= this.field.value.convert_to_list_after)">
                <a v-for="local in locals"
                   :title=" (local.translated?'Translated':'Untranslated')+' Language'"
                   :class="'btn btn-lang btn-default '+  (local.translated?'btn-primary':'btn-secondary') "
                   href="#" @click.prevent="localClicked(local.value)">{{local.label}}</a>
            </div>

            <div
                 v-if="this.field.value.style=='list' || (this.field.value.style=='mix' && locals.length > this.field.value.convert_to_list_after)">
                <select :id="field.name" v-model="currentLocal" class="w-full form-control form-select" :class="errorClasses" :placeholder="field.name" v-on:change="changeLocal">
                    <option v-for="local in locals" :value="local.value">{{ local.label }}</option>
                </select>
                <!--<select :id="field.name" v-model="currentLocal"  class="w-full form-control form-select" :class="errorClasses" :placeholder="field.name" v-on:change="changeLocal">-->
                    <!--<option v-for="(value, key) in locals" :value="key">{{ value }}</option>-->
                <!--</select>-->
            </div>

            <!--<select :id="field.name" v-model="currentLocal"  class="w-full form-control form-select" :class="errorClasses" :placeholder="field.name" v-on:change="changeLocal">-->
                <!--<option v-for="(value, key) in locals" :value="key">{{ value }}</option>-->
            <!--</select>-->
            <!--<p v-if="hasError" class="my-2 text-danger">-->
                <!--{{ firstError }}-->
            <!--</p>-->
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

        localClicked(local) {
            this.currentLocal = local
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
    },

    created: function() {
        if(this.field.value.locales.length > 0) {
            this.locals = this.field.value.locales
        }
    },

    mounted() {
        if (this.field.value.style == 'list' || (this.field.value.style == 'mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)) {
            let locales = this.field.value.locales;
            locales.map(function (item) {
                if (item.translated)
                    item.label += " -translated";
                return item;
            });
            Object.assign(this.field, {"options": this.field.value.locales});
        }
    }
}
</script>
