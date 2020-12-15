<template>
    <fieldset>
        <div class="form-card">
            <div class="row">
                <div class="col-7">
                    <h2 class="fs-title">All your Information:</h2>
                </div>
                <div class="col-5">
                    <h2 class="steps">Step 3 - 4</h2>
                </div>
            </div> 

            <ul>
                <li v-for="item in messages" :key="item">
                    {{ item }}
                </li>
            </ul>


            <div class="form-group">
                <label class="fieldlabels"><strong>First Name : </strong></label> 
                <label class="fieldlabels">{{personal.fname}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Last Name : </strong></label> 
                <label class="fieldlabels">{{personal.lname}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Contact No : </strong></label> 
                <label class="fieldlabels">{{personal.phone}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Address : </strong></label> 
                <label class="fieldlabels">{{personal.address}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company Name : </strong></label> 
                <label class="fieldlabels">{{company.cName}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company No : </strong></label> 
                <label class="fieldlabels">{{company.cNumero}}</label> 
            </div>
            <div class="form-group">
                <label class="fieldlabels"><strong>Company Address : </strong></label> 
                <label class="fieldlabels">{{company.cAddress}}</label> 
            </div>
        </div> 
        <input type="button" name="Save" class="action-button" v-bind:class="{next: isActive}" value="Submit" @click="save" /> 
        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
    </fieldset>
</template>

<script>
export default {
    data(){
        return {
            personal: [],
            company: [],
            messages: [],
            isActive: false
        }
    },
    mounted() {
        
            if (localStorage.getItem('personal')) {
                this.personal = JSON.parse(localStorage.getItem('personal'));
            }
            if (localStorage.getItem('company')) {
                this.company = JSON.parse(localStorage.getItem('company'));
            }
    },
    computed: {
        statePersonal () {
             return this.personal = this.$store.getters.statePersonal;
        }
    },
    methods: {
        save(){
            axios.post('api/createContact',this.personal).then(response => {
                if(response.data.error){
                    Object.values(response.data.error).forEach(val => {
                            this.messages = val;
                    });
                }

                if(response.data){
                    this.setActive = true;
                    this.next();
                    console.log(response.data);
                }
            }
            );
        },

        next(){   

            $(document).ready(function(){

                var current_fs, next_fs;
                var opacity;
                var current = 3;
                var steps = $("fieldset").length;
                
                setProgressBar(++current);

                
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