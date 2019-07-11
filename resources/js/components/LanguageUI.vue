<template>
    <div>
        <div v-if="this.field.value.style=='button' || (this.field.value.style=='mix' && locals.length <= this.field.value.convert_to_list_after)">
            <span v-for="local in this.field.value.locales" class=" mb-2">
                <a :title=" (local.translated?'Translated':'Untranslated')+' Language'"
                   :class="'btn btn-lang btn-default '+  (local.translated ?  'btn-translated' + (local.selected?'-selected':'') :'btn-untranslated' + (local.selected?'-selected':''))"
                   href="#" @click.prevent="$emit('change', local.value)">{{local.label}}</a>

                <a href="" v-if="local.translated && translatedCount > 1"
                   @click.prevent="$emit('delete', local.value)"
                   class="text-primary no-underline text-xs">
                    Delete
                </a>
            </span>
        </div>

        <div v-if="this.field.value.style=='list' || (this.field.value.style=='mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)">
            <select :id="field.name" v-model="selectedLocale" class="w-full form-control form-select"
                    :class="errorClasses" :placeholder="field.name" v-on:change="$emit('change', selectedLocale)">
                <option v-for="local in this.field.value.locales" :value="local.value">{{ local.label }}</option>
            </select>
        </div>
    </div>
    <!--<div>
        <div class="" v-if="this.field.value.style == 'list' ||(this.field.value.style == 'mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)">
            <select v-model="selectedLocale" :id="field.name" class="w-full form-control form-select" :class="errorClasses" v-on:change="$emit('change', selectedLocale)">
                <option v-for="option in this.field.value.locales" :value="option.value">
                    {{ option.label }}
                </option>
            </select>
        </div>
    </div>-->
</template>

<script>
    export default {
        props: ["field"],

        data: function () {
            return {
                selectedLocale: window.config.currentLocal
            };
        },
        computed: {
            translatedCount() {
                let count = 0;
                this.field.value.locales.forEach(locale => {
                    if (locale.translated) {
                        count++;
                    }
                });

                return count;
            }
        }
    };
</script>
