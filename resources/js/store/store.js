import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
 
export default new Vuex.Store({
    state: {
        personal: [],
        company: []
    },
    mutations:{

        addPersonal(state, value){
            state.personal = value;
        },

        addCompany(state, value){
            state.company = value;
        }
    },
    actions: {
        addPersonal(context, value){ 
            context.commit('addPersonal', value);
            console.log('Personal Has Been Added');
        },

        addCompany(context, value){ 
            context.commit('addCompany', value);
            console.log('Company Has Been Added');
        }
    },
    /* getters: {
        modifiedPersonal:state => {
            if (state.personal) {
                //console.log("the first name "+state.personal.map(item => item.fname)); 
            }
        }
        
      } */
});

