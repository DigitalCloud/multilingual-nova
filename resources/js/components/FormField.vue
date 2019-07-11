<template>
    <default-field :field="field">
        <template slot="field">
            <div v-if="this.field.value.style=='button' || (this.field.value.style=='mix' && locals.length <= this.field.value.convert_to_list_after)">
                <a v-for="local in locals"
                   :title=" (local.translated?'Translated':'Untranslated')+' Language'"
                   :class="'btn btn-lang btn-default '+  (local.translated ?  'btn-translated' + (local.selected?'-selected':'') :'btn-untranslated' + (local.selected?'-selected':''))"
                   href="#" @click.prevent="localClicked(local.value)">{{local.label}}</a>
            </div>

            <div
                    v-if="this.field.value.style=='list' || (this.field.value.style=='mix' && locals.length > this.field.value.convert_to_list_after)">
                <select :id="field.name" v-model="currentLocal" class="w-full form-control form-select"
                        :class="errorClasses" :placeholder="field.name" v-on:change="changeLocal">
                    <option v-for="local in locals" :value="local.value">{{ local.label }}</option>
                </select>
            </div>

        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import {global} from '../mixin/global'

    export default {
        mixins: [FormField, HandlesValidationErrors, global],

        props: ['resourceName', 'resourceId', 'field'],

        data: function () {
            return {
                currentLocal: window.config.currentLocal,
                locals: window.config.locals,
                fields: [],
                isEditing: false,
            }
        },

        created: function () {
            if (this.field.value.locales.length > 0) {
                this.locals = this.field.value.locales
            }
        },

        mounted() {
            if (this.field.value.style == 'list' || (this.field.value.style == 'mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)) {
                let locales = this.field.value.locales;
                locales.map(function (item) {
                    if (item.translated)
                        item.label += " - translated";
                    return item;
                });
                Object.assign(this.field, {"options": this.field.value.locales});
            }
            this.isEditing = false;

            this.$parent.$children.forEach(component => {
                if (component.field !== undefined) {
                    component.$watch('value', (value) => {
                        value = value.replace('<div><br></div>', '');
                        component.field.value = component.field.value.replace('<div><br></div>', '');
                        if (component.field.value !== value) {
                            this.isEditing = true;
                        }
                    });
                }
            });
        }
    }
</script>
