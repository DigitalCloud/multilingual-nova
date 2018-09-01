<template>
    <panel-item :field="field">
        <div slot="value">
            <div>
                <a v-for="locale in this.field.value.locales"
                   :title=" (locale.translated?'Translated':'Untranslated')+' Language'"
                   :class="'btn btn-sm btn-default '+  (locale.translated?'btn-primary':'btn-secondary') "
                   :href="getLangUrl(locale)">{{locale.label}}</a>
            </div>
        </div>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    methods: {
        getLangUrl(locale) {
            return this.field.value.id
                + "?lang=" + locale.value;
        }
    }
}
</script>

<style>
    .btn-sm {
        margin-left: 10px;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 12px;
        font-weight: normal;
    }

    .btn-secondary {
        background-color: #c4c5d6;
        color: black;
    }
</style>