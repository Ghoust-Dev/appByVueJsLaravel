import Vue from "vue";
import Vuex from "vuex";
import VuexPersistence from 'vuex-persist'

Vue.use(Vuex);
 
export default new Vuex.Store({
    state: {
        personal: [],
        company: []
    },
    mutations:{
        ajoutPersonal(state){
            if(localStorage.getItem('personal')) {
                    state.personal = localStorage.getItem('personal');
            }
        },

        ajoutCompany(state){
            if(localStorage.getItem('company')) {
                    state.company = localStorage.getItem('company');
            }
        }
    },
    getters: {
        statePersonal: state => {
          return state.personal;
        }
      }
});

