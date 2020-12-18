<template>
    <fieldset  id="Success">
        <div class="form-card">
            <div class="row">
                <div class="col-7">
                    <h2 class="fs-title">Finish:</h2>
                </div>
                <div class="col-5">
                    <h2 class="steps">Step 4 - 4</h2>
                </div>
            </div> <br><br>
            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
            <div class="row justify-content-center">
                <div class="col-3"> <img src="images/GwStPmg.png" class="fit-image"> </div>
            </div> <br><br>
            <div class="row justify-content-center">
                <div class="col-7 text-center">
                    <h5 class="purple-text text-center">You Have Successfully Added Your Information</h5>
                </div>
            </div>
        </div>
    </fieldset>
</template>
<script>
export default {
    data(){
        return {
            step: null
        }
    },
    mounted() {

        if (JSON.parse(localStorage.getItem('step')) === 4) {
            this.loadComponent();
            return this.$store.dispatch('updateStep',JSON.parse(localStorage.getItem('step')));
        }
    },
    methods: {
        /* loadState(){
            let newStep = ++this.step;
            this.$store.dispatch('addStep',newStep);
        }, */
        loadComponent(){            
            //Progress Bar Style
            var opacity;
            var current = JSON.parse(localStorage.getItem('step'));;
            var steps = $("fieldset").length;
            
            $("#Success").show();
            
            $("#step2 li").addClass("active");
            $("#step3 li").addClass("active");
            $("#step4 li").addClass("active");
            
            $("#Personal, #Company, #Validate").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Personal,  #Company, #Validate").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Success").css({'opacity': opacity});
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
        }

        
    }
}
</script>