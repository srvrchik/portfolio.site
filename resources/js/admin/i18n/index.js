import Vue from 'vue'
import VueI18n from 'vue-i18n'

import En from './languages/en'
import Ru from './languages/ru'

Vue.use(VueI18n);


const messages = {
    ru: Ru,
    en: En,
};

export default new VueI18n({
    locale: 'ru',
    fallbackLocale: 'ru',
    messages: messages
})
