<template>
    <span>
        <div>
            <a v-for="locale in this.field.value.locales"
               :title=" (locale.translated?'Translated':'Untranslated')+' Language'"
               :class="'btn btn-sm btn-default '+  (locale.translated?'btn-primary':'btn-secondary') "
               :href="getLangUrl(locale)">{{locale.label}}</a>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],

        methods: {
            getLangUrl(locale) {
                console.log(this.field);
                return Nova.config.base
                    + "/resources/"
                    + this.resourceName + "/"
                    + this.field.value.id + "/edit"
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