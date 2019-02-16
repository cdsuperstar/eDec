import Vuex from "vuex";
import auth from "./modules/auth/index";
import lang from "./modules/lang/index";
import bus from "./modules/bus/index";

const modules = {
    auth,
    lang,
    bus
};

const store = new Vuex.Store({
    modules
});

export { store };
