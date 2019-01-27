function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

Nova.booting((Vue, router) => {
    Vue.component('index-multilingual-nova', require('./components/IndexField'));
    Vue.component('detail-multilingual-nova', require('./components/DetailField'));
    Vue.component('form-multilingual-nova', require('./components/FormField'));

    Vue.component('language-selector', require('./components/LanguageSelector'));

    router.addRoutes([
        {
            name: 'nova-language-tool',
            path: '/nova-language-tool',
            component: require('./components/Tool'),
        },
    ])

    let lang = getParameterByName('lang');
    if (lang) {
        Nova.request().defaults.headers['lang'] = lang;
    }
})
