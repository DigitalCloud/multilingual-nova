<template>
  <div>
    <div v-if="this.field.value.style=='button' || (this.field.value.style=='mix' && this.field.value.locales.length <= this.field.value.convert_to_list_after)">
        <span v-for="local in this.field.value.locales" :key="local.value" class=" mb-2 inline-flex">
            <a :title=" (local.translated?'Translated':'Untranslated')+' Language'"
                :class="'btn btn-lang btn-default ' + ((local.translated && translatedCount > 1) ? 'btn-with-delete ' : '') + 'btn-language-' + local.value + ' ' +  (local.translated ?  'btn-translated' + (local.selected?'-selected':'') :'btn-untranslated' + (local.selected?'-selected':''))"
                href="#" @click.prevent="$emit('change', local.value)">{{local.label}}</a>
            <a href="" v-if="local.translated && translatedCount > 1"
               @click.prevent="openRemoveModal(local.value)"
                class="btn-delete">X</a>
        </span>
    </div>

    <div v-if="this.field.value.style=='list' || (this.field.value.style=='mix' && this.field.value.locales.length > this.field.value.convert_to_list_after)">
      <select :id="field.name" v-model="selectedLocale" class="w-full form-control form-select"
              :class="errorClasses" :placeholder="field.name" v-on:change="$emit('change', selectedLocale)">
        <option v-for="local in this.field.value.locales" :key="local.value" :value="local.value">{{ local.label }}</option>
      </select>
    </div>

    <portal to="modals" transition="fade-transition">
      <component
          v-if="removeModalOpen"
          class="text-left"
          is="delete-resource-modal"
          @confirm="confirmDelete"
          @close="closeRemoveModal"
      />
    </portal>
  </div>
</template>

<script>
export default {
  props: ["field"],

  data: function () {
    return {
      selectedLocale: window.config.currentLocal,
      removeModalOpen: false,
      deletedItem: null,
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
  },
  methods: {
    openRemoveModal(value) {
      this.removeModalOpen = true;
      this.deletedItem = value;
    },
    closeRemoveModal() {
      this.removeModalOpen = false;
      this.deletedItem = null;
    },
    confirmDelete() {
      this.$emit('delete', this.deletedItem);
    },
  }
};
</script>