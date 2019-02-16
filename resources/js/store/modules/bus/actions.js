import { master } from "../../../plugins/master";

export default {
    showLogin({ commit }, value) {
        commit("SHOW_LOGIN", value);
        commit("SHOW_REGISTER", false);
    },
    showRegister({ commit }, value) {
        commit("SHOW_REGISTER", value);
        commit("SHOW_LOGIN", false);
    },
    getMycompany({ commit }) {
        master.self
            .$axios({
                method: "get",
                url: "/api/v1/company/mine"
            })
            .then(response => {
                if (response.data.id) {
                    commit("set_company_info", response.data);
                } else {
                    master.self.$router.push("/user/applyb");
                }
            });
    },
    async updateMycompany({ dispatch, state }) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "post",
                    url: "/api/v1/company/apply",
                    data: state.company
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getMycompany");
                        resolve(response);
                    } else {
                        reject(response.data.messages);
                    }
                })
                .catch(errors => {
                    reject(errors);
                });
        });
    },
    getMyproducts({ commit }) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "get",
                    url: "/api/v1/product/getMyProducts"
                })
                .then(response => {
                    if (response.data.success) {
                        commit("set_myproducts_info", response.data.data);
                        resolve(response);
                    } else {
                        reject(response.data.errors);
                    }
                });
        });
    },
    async updateMyproduct({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "post",
                    url: master.api("/product/updateProduct"),
                    data: payload
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getMyproducts");
                        resolve(response);
                    } else {
                        reject(response.data.messages);
                    }
                })
                .catch(errors => {
                    reject(errors);
                });
        });
    },
    async addMyproduct({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "post",
                    url: master.api("/product/add"),
                    data: payload
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getMyproducts");
                        resolve(response);
                    } else {
                        reject(response.data.messages);
                    }
                })
                .catch(errors => {
                    reject(errors);
                });
        });
    },
    delMyproducts({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "delete",
                    url: "/api/v1/product/delMany",
                    data: { toDel: payload }
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getMyproducts");
                        resolve(response);
                    } else {
                        reject(response.data.messages);
                    }
                })
                .catch(e => {
                    reject(e);
                });
        });
    },
    getPrcoupons({ commit }) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "get",
                    url: "/api/v1/prcoupon/getCoupons"
                })
                .then(response => {
                    if (response.data.success) {
                        commit("set_prcoupons_info", response.data.data);
                        resolve(response);
                    } else {
                        reject(response.data.errors);
                    }
                })
                .catch(e => {
                    reject(e);
                });
        });
    }
    // logout({ commit }) {
    //     master.self
    //         .$axios({
    //             method: "post",
    //             url: master.api("/oauth/logout")
    //         })
    //         .then(response => {
    //             commit("SET_AUTH_STATUS", false);
    //             commit("SET_USER_INFO", {});
    //             let timer = new master.Timer(() => {
    //                 auth(commit);
    //             }, 300000);
    //             commit("RELOAD_AUTH_STATUS", timer);
    //             let routeName = master.getValue(master.self.$route, ["name"]);
    //             if (routeName) {
    //                 let route = routeName.split(".")[0].toLowerCase();
    //                 switch (route) {
    //                     case "user":
    //                         master.self.$router.replace({
    //                             name: "public.index"
    //                         });
    //                         break;
    //                     default:
    //                         //
    //                         break;
    //                 }
    //             }
    //         });
    // }
};
