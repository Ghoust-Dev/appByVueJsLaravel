import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
 
export default new Vuex.Store({
    state: {
        personal: [],
        company: [],
        step: 1
    },
    mutations:{

        addPersonal(state, value){
            state.personal = value;
        },

        addCompany(state, value){
            state.company = value;
        },

        updateStep(state, value){
            state.step = value;
        },

        incrementStep(state, value){
            state.step = ++value;
            console.log('decrementStep is '+value);
        },

        decrementStep(state, value){
            state.step = --value;
            console.log('decrementStep is '+value);
        }
    },
    actions: {
        addPersonal(context, value){ 
            context.commit('addPersonal', value);
        },

        addCompany(context, value){ 
            context.commit('addCompany', value);
        },

        updateStep(context, value){ 
            context.commit('updateStep',value);
        },

        incrementStep(context, value){ 
            context.commit('incrementStep',value);
        },

        decrementStep(context, value){ 
            context.commit('decrementStep',value);
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

