import VueI18n from 'vue-i18n';
import zh from './locale/zh/zh';

export const i18n = new VueI18n({
    locale: 'zh',
    fallbackLocale: 'zh',
    messages: {
        zh
    }
});