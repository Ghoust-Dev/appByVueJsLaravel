<template>
    <fieldset id="Validate">
        <div class="form-card" >
            <div class="row">
                <div class="col-7">
                    <h2 class="fs-title">All your Information:</h2>
                </div>
                <div class="col-5">
                    <h2 class="steps">Step 3 - 4</h2>
                </div>
            </div> 

            <ul class="" v-bind:class="{'alert alert-danger': messageError}">
                <li v-for="item in messages" :key="item">
                    {{ item }}
                </li>
            </ul>


            <div class="form-group">
                <label class="fieldlabels"><strong>First Name : </strong></label> 
                <label class="fieldlabels" >{{retreivePersonal.fname}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Last Name : </strong></label> 
                <label class="fieldlabels">{{retreivePersonal.lname}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Email : </strong></label> 
                <label class="fieldlabels">{{retreivePersonal.email}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Contact No : </strong></label> 
                <label class="fieldlabels" >{{retreivePersonal.phone}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Address : </strong></label> 
                <label class="fieldlabels">{{retreivePersonal.address}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company Name : </strong></label> 
                <label class="fieldlabels">{{retreiveCompany.cName}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company No : </strong></label> 
                <label class="fieldlabels">{{retreiveCompany.cNumero}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company Address : </strong></label> 
                <label class="fieldlabels">{{retreiveCompany.cAddress}}</label> 
            </div>
        </div> 
        <input type="button" name="Save" class="action-button" v-bind:class="{next: isActive}" value="Submit" @click="save" /> 
        <input type="button" name="previous" class="action-button-previous" value="Previous" v-on:click="previousForm"/>
    </fieldset>
</template>

<script>
export default {
    data(){
        return {
            personal: [],
            company: [],
            messages: [],
            isActive: false,
            messageError: false
        }
    },
    computed: {
        retreivePersonal () {
            this.personal = this.$store.state.personal;
            return this.personal;
        },

        retreiveCompany () {
            this.company = this.$store.state.company;
            return this.$store.state.company;
        }
    },
    mounted() {
        if (JSON.parse(localStorage.getItem('step')) === 3) {
            this.loadComponent();
            this.$store.state.personal = JSON.parse(localStorage.getItem('personal'));
            this.$store.state.company = JSON.parse(localStorage.getItem('company'));
            
           return this.$store.dispatch('updateStep',JSON.parse(localStorage.getItem('step')));
        }
        
    },
    methods: {

        save(){
            
            axios.post('api/createContact',this.retreivePersonal).then(response => {
                if(!response.data.statu){
                    console.log(response.data);
                    Object.values(response.data.error).forEach(val => {
                        this.messageError = true;
                        this.messages = val;
                    });
                }

                if(response.data.statu){
                    this.setActive = true;
                    this.nextForm();
                }
            }
            );
        },
        loadComponent(){            
            //Progress Bar Style
            var opacity;
            var current = JSON.parse(localStorage.getItem('step'));;
            var steps = $("fieldset").length;
            
            $("#Validate").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").addClass("active");
            $("#step4 li").removeClass("active");
            
            $("#Personal, #Company").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Personal,  #Company").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Validate").css({'opacity': opacity});
                },
                duration: 500
            });
            
            setProgressBar(current);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                console.log('steps is '+steps+' curStep is '+curStep);
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }
        },
        nextForm(){            
            //Progress Bar Style
            var opacity;
            var current =  this.$store.state.step;
            var steps = $("fieldset").length;
            
            $("#Success").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").addClass("active");
            $("#step4 li").addClass("active");
            
            $("#Company, #Personal, #Validate").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Company, #Personal, #Validate").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Success").css({'opacity': opacity});
                },
                duration: 500
            });
            
            setProgressBar(++current);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }

            localStorage.setItem('step',current);
            return this.$store.dispatch('incrementStep',this.$store.state.step);
        },
        previousForm(){            
            //Progress Bar Style
            var opacity;
            var current = this.$store.state.step;
            var steps = $("fieldset").length;
            
            $("#Company").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").removeClass("active");
            $("#step4 li").removeClass("active");
            
            $("#Validate").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Validate").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Company").css({'opacity': opacity});
                },
                duration: 500
            });
            
            setProgressBar(--current);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }
            
            localStorage.setItem('step',current);
            return this.$store.dispatch('decrementStep',this.$store.state.step);
                
        }

        
    }
}
</script>