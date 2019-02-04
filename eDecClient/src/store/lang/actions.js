import { master } from 'plugins/master'

const quasarLang = (lang) => {
  switch (lang) {
    case 'zh-hans':
      return 'zh-hans'
    case 'en-us':
      return 'en-us'
    default:
      return 'zh-hans'
  }
}

const veeLang = (lang) => {
  switch (lang) {
    case 'zh-hans':
      return 'zh_CN'
    case 'en-us':
      return 'en'
    default:
      return 'zh_CN'
  }
}

const momentLang = (lang) => {
  switch (lang) {
    case 'zh-hans':
      return 'zh-cn'
    case 'en-us':
      return 'en-us'
    default:
      return 'zh-cn'
  }
}

const localLang = (lang) => {
  switch (lang) {
    case 'zh-hans':
      return 'zh-hans'
    case 'en-us':
      return 'en-us'
    default:
      return 'zh-hans'
  }
}

export default {
  async setLanguage ({commit}, lang) {
    try {
      let qLang = quasarLang(lang)
      import(`quasar-framework/i18n/${qLang}`).then(lang => {
        master.self.$q.i18n.set(lang.default)
      })
      let vLang = veeLang(lang)
      import(`vee-validate/dist/locale/${vLang}`).then(lang => {
        master.self.$validator.localize(vLang, lang)
      })
      import(`../../i18n/${lang}`).then(res => {
        master.self.$i18n.setLocaleMessage(localLang(lang), res.default)
        master.self.$i18n.locale = localLang(lang)
      })
      master.self.$moment.locale(momentLang(lang))
      commit('SET_LANGUAGE', lang)
    } catch (e) {
      console.log('lang_error', e)
    }
  }
}
