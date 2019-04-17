import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        departmentId: null,
        microPcs : [],
        microPcSelected: [],
        microPcsWhenUpdate: [],
        responMicroPcsBeforeUpdate: [],
        enablePopupView: false,
        infoFile: {}
    },

    getters: {
        getFiles: state => {
            return state.files
        }
    },

    mutations: {
        addFile(state, newFile) {
            state.files.push(newFile);
        }
    },

    actions: {
        fetchFiles(state){

        }
    }
});