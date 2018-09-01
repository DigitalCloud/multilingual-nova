<template>
    <panel-item :field="field">
        <div slot="value">
            <div v-for="locale in this.field.value.locales">
                <a :href="getLangUrl(locale)">{{locale.label}}</a>
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
