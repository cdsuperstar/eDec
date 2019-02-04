import { master } from 'plugins/master'

export default {
  lang (state) {
    return state.language
  },
  list (state) {
    return state.lang_list
  },
  langCookie () {
    let lang = 'zh-hans'
    if (master.self.$q.cookies.has('lang')) {
      lang = master.self.$q.cookies.get('lang')
    }
    switch (lang) {
      case 'zh-hans':
      case 'en-us':
      default:
        return 'zh-hans'
    }
  }
}
