<template>
    <fieldset>
        <div class="form-card">
            <div class="row">
                <div class="col-7">
                    <h2 class="fs-title">Company Information:</h2>
                </div>
                <div class="col-5">
                    <h2 class="steps">Step 2 - 4</h2>
                </div>
            </div> 
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </p>
                <label class="fieldlabels">Company Name: *</label> 
                <input type="text" name="cName" placeholder="Company Name" v-model="company.cName" required/> 
                <label class="fieldlabels">Company No.: *</label> 
                <input type="text" name="cNumero" placeholder="Company No." v-model="company.cNumero" required/> 
                <label class="fieldlabels">Company Address: *</label> 
                <input type="text" name="cAddress" placeholder="Company Address" v-model="company.cAddress" required/>
        </div> 
        <input type="button" name="next" class="action-button" v-bind:class="{next: isActive}" value="Next" v-on:click="checkForm"/> 
        <input type="button" name="previous" class="previous action-button-previous" value="Previous"  />
    </fieldset>
</template>

<script>
export default {
    data(){
        return {
            company: {
                cName:'',
                cNumero:'',
                cAddress:''
            },
            errors: {
                cName:null,
                cNumero:null,
                cAddress:null
            },
            isActive: false
        }
    },
    mounted() {
        if (localStorage.getItem('company')) {
            this.company = JSON.parse(localStorage.getItem('company'));
        }
    },
    methods: {
        checkForm: function (e) {
            if (this.company.cName && this.company.cNumero && this.company.cAddress) {
                this.isActive = true;
                this.next();
                return true;
            }
            
            this.errors = [];

            if (!this.company.cName) {
                this.errors.push('Name Company required.');
            }

            if (!this.company.cNumero) {
                this.errors.push('Phone Company required.');
            }

            if (!this.company.cAddress) {
                this.errors.push('Address Company required.');
            }

            e.preventDefault();
            },

        next(){

            localStorage.setItem('company',JSON.stringify(this.company));
            
            //JQuery Script
            $(document).ready(function(){

                var current_fs, next_fs;
                var opacity;
                var current = 2;
                var steps = $("fieldset").length;
                
                setProgressBar(++current);
                
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

            let newCompany = this.company;
            return this.$store.dispatch('addCompany',newCompany);
        }
    }
}
</script>