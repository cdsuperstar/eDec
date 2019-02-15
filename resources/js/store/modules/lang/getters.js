import { master } from "../../../plugins/master";

export default {
    lang(state) {
        return state.language;
    },
    list(state) {
        return state.lang_list;
    },
    langCookie() {
        let lang = "zh";
        if (master.self.$q.cookies.has("lang")) {
            lang = master.self.$q.cookies.get("lang");
        }
        switch (lang) {
            case "zh":
            case "en":
            default:
                return "zh";
        }
    }
};
