<template>
    <div>
        <div v-if="this.field.value.style=='button' || (this.field.value.style=='mix' && this.field.value.locales.length <= this.field.value.convert_to_list_after)">
            <a v-for="locale in this.field.value.locales"
               :title=" (locale.translated?'Translated':'Untranslated')+' Language'"
               :class="'btn btn-lang btn-default '+  (locale.translated?'btn-primary':'btn-secondary') "
               href="#" @click.prevent="$emit('change', locale.value)">{{locale.label}}</a>
        </div>

        <div class="w-1/2"
             v-if="this.field.value.style=='list' || (this.field.value.style=='mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)">
            <select v-model="selectedLocale" :id="field.name" class="w-full form-control form-select"
                    :class="errorClasses"
                    v-on:change="$emit('change', selectedLocale)">
                <option v-for="option in this.field.value.locales" :value="option.value">
                    {{ option.label }}
                </option>
            </select>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['field']
    }
</script>