import { master } from "../../../plugins/master";

export default {
    getMycompany({ commit }) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "get",
                    url: "/api/v1/company/mine"
                })
                .then(response => {
                    if (response.data.data.id) {
                        commit("set_company_info", response.data.data);
                        resolve(response.data);
                    } else {
                        reject(response.data.errors);
                        // master.self.$router.push("/user/applyb");
                    }
                });
        });
    },
    updateMycompany({ dispatch, state }) {
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
    updateMyproduct({ dispatch }, payload) {
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
    addMyproduct({ dispatch }, payload) {
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
    },
    updatePrcoupon({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "post",
                    url: master.api("/prcoupon/updateItem"),
                    data: payload
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getPrcoupons");
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
    addPrcoupon({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "post",
                    url: master.api("/prcoupon/add"),
                    data: payload
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getPrcoupons");
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
    delPrcoupons({ dispatch, commit }, payload) {
        return new Promise((resolve, reject) => {
            master.self
                .$axios({
                    method: "delete",
                    url: "/api/v1/prcoupon/delMany",
                    data: { toDel: payload }
                })
                .then(response => {
                    if (response.data.success) {
                        dispatch("getPrcoupons");
                        resolve(response);
                    } else {
                        reject(response.data.messages);
                    }
                })
                .catch(e => {
                    reject(e);
                });
        });
    }
};
