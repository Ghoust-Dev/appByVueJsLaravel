<template>
    <fieldset >
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
            personal: {
                fname:'',
                lname:'',
                email:'',
                phone:'',
                address:''
            },
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
        if (localStorage.getItem('personal')) {
            this.personal = JSON.parse(localStorage.getItem('personal'));
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

            this.$store.commit('ajoutPersonal');
            
            localStorage.setItem('personal',JSON.stringify(this.personal));
            
            $(document).ready(function(){

                var current_fs, next_fs;
                var opacity;
                var current = 1;
                var steps = $("fieldset").length;
                
                setProgressBar(++current);

                //$(".next").
                
                $(".next").click(function(){
                
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                
                next_fs.show();
                current_fs.animate({opacity: 0}, {
                step: function(now) {
                opacity = 1 - now;
                
                current_fs.css({
                'display': 'none',
                'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
                },
                duration: 500
                });
                setProgressBar(++current);
                });
                
                function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
                }
                
                $(".submit").click(function(){
                return false;
                })

                });
        }
    }
}
</script>