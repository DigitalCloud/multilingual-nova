<template>
	<panel-item :field="field">
		<div slot="value">
			<language-u-i
				:field="field"
				v-on:change="redirect"
				v-on:delete="deleteLocale"
			/>
		</div>
	</panel-item>
</template>

<script>
import LanguageUI from "./LanguageUI";

export default {
	props: ["resource", "resourceName", "resourceId", "field"],
	components: {
		LanguageUI
	},
	methods: {
		redirect(locale) {
			if (locale !== undefined) {
				window.location = this.field.value.id + "?lang=" + locale;
				return;
			}

			window.location = this.field.value.id;
		},
		deleteLocale(locale) {
			Nova.request().post(
				"/nova-vendor/multilingual-nova/remove-local/" +
					locale +
					"?resourceId=" +
					this.resourceId +
					"&resourceName=" +
					this.resourceName,
				{
					_method: "DELETE"
				}
			);
			this.redirect();
		}
	},
	mounted() {
		if (
			this.field.value.style == "list" ||
			(this.field.value.style == "mix" &&
				this.field.value.locales.length >
					this.field.value.convert_to_list_after)
		) {
			let locales = this.field.value.locales;
			locales.map(function(item) {
				if (item.translated) item.label += " -translated";
				return item;
			});
			Object.assign(this.field, { options: this.field.value.locales });
		}
	}
};
</script>