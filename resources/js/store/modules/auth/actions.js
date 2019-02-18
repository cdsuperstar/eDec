import { master } from "../../../plugins/master";

const auth = commit => {
    master.self
        .$axios({
            method: "get",
            url: master.api("/oauth/check")
        })
        .then(response => {
            let status = Boolean(master.getValue(response, ["data", "auth"]));
            commit("SET_AUTH_STATUS", status);
        })
        .catch(error => {
            commit("SET_AUTH_STATUS", false);
        });
};

export default {
    showLogin({ commit }, value) {
        commit("SHOW_LOGIN", value);
        commit("SHOW_REGISTER", false);
    },
    showRegister({ commit }, value) {
        commit("SHOW_REGISTER", value);
        commit("SHOW_LOGIN", false);
    },
    getUserInfo({ commit }) {
        master.self
            .$axios({
                method: "get",
                url: master.api("/user")
            })
            .then(response => {
                commit("SET_USER_INFO", response.data.data);
            });
    },
    setUserInfo({ commit }, data) {
        commit("SET_USER_INFO", data);
    },
    getAuthStatus({ commit }) {
        auth(commit);
        let timer = new master.Timer(() => {
            auth(commit);
        }, 300000);
        commit("RELOAD_AUTH_STATUS", timer);
    },
    reloadAuthStatus({ commit }) {
        let timer = new master.Timer(() => {
            auth(commit);
        }, 300000);
        commit("RELOAD_AUTH_STATUS", timer);
    },
    setAuthStatus({ commit }, value) {
        commit("SET_AUTH_STATUS", Boolean(value));
    },
    logout({ commit }) {
        master.self
            .$axios({
                method: "post",
                url: master.api("/oauth/logout")
            })
            .then(response => {
                commit("SET_AUTH_STATUS", false);
                commit("SET_USER_INFO", {});
                let timer = new master.Timer(() => {
                    auth(commit);
                }, 300000);
                commit("RELOAD_AUTH_STATUS", timer);
                let routeName = master.getValue(master.self.$route, ["name"]);
                if (routeName) {
                    let route = routeName.split(".")[0].toLowerCase();
                    switch (route) {
                        case "user":
                            master.self.$router.replace({
                                name: "public.index"
                            });
                            break;
                        default:
                            //
                            break;
                    }
                }
                // window.localStorage.clear();
                // window.sessionStorage.clear();
                // let cookies = document.cookie.split(";");
                //
                // for (let i = 0; i < cookies.length; i++) {
                //     let cookie = cookies[i];
                //     let eqPos = cookie.indexOf("=");
                //     let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                //     document.cookie =
                //         name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                // }
                master.self.$q.notify({
                    message: master.self.$t("login.success_logout"),
                    type: "positive"
                });
                master.Timer(() => {
                    window.location.href = "/";
                }, 500);
            });
    }
};
