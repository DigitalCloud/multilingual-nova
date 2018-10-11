<template>
    <panel-item :field="field">
        <div slot="value">
            <language-u-i :field="field" v-on:change="redirect"/>
        </div>
    </panel-item>
</template>

<script>
    import LanguageUI from './LanguageUI'

    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        components: {
            LanguageUI
        },
        methods: {
            redirect(locale) {
                window.location = this.field.value.id
                    + "?lang=" + locale;
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