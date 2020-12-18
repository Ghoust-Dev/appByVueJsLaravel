<template>
    <fieldset id="Company">
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
        <input type="button" name="next" class="action-button" value="Next" v-on:click="checkForm"/> 
        <input type="button" name="previous" class="action-button-previous" value="Previous"  v-on:click="previousForm"/>
    </fieldset>
</template>

<script>
export default {
    data(){
        return {
            company: {},
            errors: {
                cName:null,
                cNumero:null,
                cAddress:null
            },
            isActive: false
        }
    },
    mounted() {

        this.company = JSON.parse(localStorage.getItem('company'));
        
        if (JSON.parse(localStorage.getItem('step')) === 2) {
            this.loadComponent();
            this.$store.state.company = JSON.parse(localStorage.getItem('company'));
            return this.$store.dispatch('updateStep',JSON.parse(localStorage.getItem('step')));
        }
    },
    methods: {
        checkForm: function (e) {
            if (this.company.cName && this.company.cNumero && this.company.cAddress) {
                console.log('this.company.cName '+this.company.cName);
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
            this.nextForm();
            return this.loadState();

        },
        loadState(){
            let newCompany = this.company;            
            this.$store.dispatch('addCompany',newCompany);
        },
        loadComponent(){            
            //Progress Bar Style
            var opacity;
            var current = JSON.parse(localStorage.getItem('step'));;
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
            
            setProgressBar(current);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $("#progress-bar").css("width",percent+"%");
                console.log('steps is '+steps+' curStep is '+curStep+' percent is '+percent);
            }
        },
        nextForm(){            
            //Progress Bar Style
            var opacity;
            var current =  this.$store.state.step;
            var steps = $("fieldset").length;
            
            $("#Validate").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").addClass("active");
            $("#step4 li").removeClass("active");
            
            $("#Company").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Company").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Validate").css({'opacity': opacity});
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

            $("#Personal").show();
            
            $("#step2 li").removeClass("active");
            $("#step3 li").removeClass("active");
            $("#step4 li").removeClass("active");
            
            $("#Company").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Company").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Personal").css({'opacity': opacity});
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