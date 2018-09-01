<template>
    <span>
        <div v-for="locale in this.field.value.locales">
            <a :href="getLangUrl(locale)">{{locale.label}}</a>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],

        methods: {
            getLangUrl(locale) {
                return Nova.config.base
                    + "/resources/"
                    + this.resourceName + "/"
                    + this.field.value.id + "/edit"
                    + "?lang=" + locale.value;
            }
        }
    }
</script>
