import axios from "axios";

const ENDPOINT_PATH = "http://strdatatechnicaltest.test/api/";

export default {
    register(form) {
        return axios.post(ENDPOINT_PATH + "register", form);
    },

    login(form) {
        return axios.post(ENDPOINT_PATH + "login", form);
    }
};
