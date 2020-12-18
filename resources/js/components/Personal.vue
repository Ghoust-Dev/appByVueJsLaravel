<template>
    <fieldset id="Personal">
        <div class="form-card">
            <div class="row">
                <div class="col-7">
                    <h2 class="fs-title">Personal Information:</h2>
                </div>
                <div class="col-5">
                    <h2 class="steps">Step 1 - 4</h2>
                </div>
            </div> 
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </p>
                <label class="fieldlabels">First Name: *</label> 
                <input type="text" name="fname" placeholder="First Name" v-model="personal.fname" required /> 
                <label class="fieldlabels">Last Name: *</label> 
                <input type="text" name="lname" placeholder="Last Name" v-model="personal.lname" required /> 
                <label class="fieldlabels">Email: *</label> 
                <input type="email" name="email" placeholder="Email Id" v-model="personal.email" required />
                <label class="fieldlabels">Contact No.: *</label> 
                <input type="text" name="phone" placeholder="Contact No." v-model="personal.phone" required /> 
                <label class="fieldlabels">Address: *</label> 
                <input type="text" name="address" placeholder="Address" v-model="personal.address"/>
        </div> 
        <input type="button" name="next" class="next action-button" value="Next" v-on:click="checkForm" />
    </fieldset>
</template>

<script>
export default {
    data(){
        return {
            personal: {},
            errors: {
                fname:null,
                lname:null,
                email:null,
                phone:null,
                address:null
            },
            isActive:false
        }
    },
    mounted() {
        this.personal = JSON.parse(localStorage.getItem('personal'));
        
        if (JSON.parse(localStorage.getItem('step')) === 1) {
            this.loadComponent();
            this.$store.state.personal = JSON.parse(localStorage.getItem('personal'));
           return this.$store.dispatch('updateStep',JSON.parse(localStorage.getItem('step')));
        }
        
    },
    methods: {
        checkForm: function (e) {
            if (this.personal.fname && this.personal.lname && this.personal.email && this.personal.phone && this.personal.address) {
                
                this.next();

                return true;
            }

            this.errors = [];

            if (!this.personal.fname) {
                this.errors.push('Name required.');
            }

            if (!this.personal.lname) {
                this.errors.push('Last Name required.');
            }

            if (!this.personal.email) {
                this.errors.push('Email required.');
            }

            if (!this.personal.phone) {
                this.errors.push('Phone required.');
            }

            if (!this.personal.address) {
                this.errors.push('Address required.');
            }

            e.preventDefault();
            },
        next(){        
            localStorage.setItem('personal',JSON.stringify(this.personal));
            this.nextForm();
            return this.loadState();
            
        },
        loadState(){
            let newPersonal = this.personal;
            return this.$store.dispatch('addPersonal',newPersonal);
        },
        loadComponent(){
            //Progress Bar Style
            var current = JSON.parse(localStorage.getItem('step'));
            var steps = $("fieldset").length;

            $("#step2 li").removeClass("active");
            $("#step3 li").removeClass("active");
            $("#step4 li").removeClass("active");

            setProgressBar(current);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
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
            
            $("#Company").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").removeClass("active");
            $("#step4 li").removeClass("active");
            
            $("#Personal").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Personal").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Company").css({'opacity': opacity});
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
        }

    }
}
</script>