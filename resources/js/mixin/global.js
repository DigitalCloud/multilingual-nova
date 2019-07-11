export const global = {
    methods: {
        redirect(locale) {
            window.location = this.replaceUrlParam(this.field.url + '/resources/' + this.resourceName + "/" + this.field.value.id + "/edit", 'lang', locale);
        },

        replaceUrlParam(url, paramName, paramValue) {
            if (paramValue == null) {
                paramValue = '';
            }
            var pattern = new RegExp('\\b(' + paramName + '=).*?(&|#|$)');
            if (url.search(pattern) >= 0) {
                return url.replace(pattern, '$1' + paramValue + '$2');
            }
            url = url.replace(/[?#]$/, '');
            return url + (url.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue;
        },

        changeLocal() {
            window.location = this.replaceUrlParam(window.location.href, 'lang', this.currentLocal);
        },

        localClicked(local) {
            if(this.isEditing) {
                if(confirm('Are you sure you want to leave the page without saving?')) {
                    this.currentLocal = local;
                    window.location = this.replaceUrlParam(window.location.href, 'lang', this.currentLocal);
                }
            } else {
                this.currentLocal = local;
                window.location = this.replaceUrlParam(window.location.href, 'lang', this.currentLocal);
            }
        },
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.currentLocal || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        deleteLocale(locale) {
            Nova.request().post(
                "/nova-vendor/multilingual-nova/remove-local/" +
                locale +
                "?resourceId=" +
                this.field.value.id +
                "&resourceName=" +
                this.resourceName,
                {
                    _method: "DELETE"
                }
            );
            window.location = this.replaceUrlParam(window.location.href, 'lang', locale);
        }
    }
}
