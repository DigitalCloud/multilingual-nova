<template>
    <language-u-i :field="field" v-on:change="redirect"/>
</template>

<script>
    import LanguageUI from './LanguageUI'

    export default {

        props: ['resourceName', 'field'],
        components: {
            LanguageUI
        },
        methods: {
            redirect(locale) {
                window.location = this.replaceUrlParam(window.location.href, 'lang', locale);
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
        }
    }
</script>
