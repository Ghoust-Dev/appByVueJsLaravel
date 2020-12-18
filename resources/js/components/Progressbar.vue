<template>
    <div> 
        <!-- progressbar -->
        <ul id="progressbar">
            <div id="step1" >
                <li class="active" id="personal" v-on:click="loadPersonal"><strong>Personal</strong></li>
            </div>
            <div id="step2" disabled>
                <li  id="company" v-on:click="loadCompany"><strong>Company</strong></li>
            </div>
            <div id="step3">
                <li  id="validate" v-on:click="loadValidate"><strong>Validate</strong></li>
            </div>
            <div id="step4">
                <li id="confirm"><strong>Finish</strong></li>
            </div>
        </ul>
        <div class="progress">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div> 
    </div> 
</template>


<script>
export default {
    methods: {
        loadPersonal(){
            var opacity;
            var step = 1;
            var steps = $("fieldset").length;

            $("#Personal").show();
            
            $("#Company, #Validate, #Success").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Company,  #Validate, #Success").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Personal").css({'opacity': opacity});
                },
                duration: 500
            });

            setProgressBar(step);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }

        },
        loadCompany(){
            var opacity;
            var step = 2;
            var steps = $("fieldset").length;

            $("#step2 li").addClass("active");
            $("#step3 li").removeClass("active");
            $("#step4 li").removeClass("active");

            $("#Company").show();
            
            $("#Personal, #Validate, #Success").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Personal,  #Validate, #Success").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Company").css({'opacity': opacity});
                },
                duration: 500
            });

            setProgressBar(step);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }

        },
        loadValidate(){
            var opacity;
            var step = 3;
            var steps = $("fieldset").length;

            $("#step2 li").addClass("active");
            $("#step3 li").addClass("active");
            $("#step4 li").removeClass("active");

            $("#Validate").show();
            
            $("#Personal, #Company, #Success").animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    $("#Personal,  #Company , #Success").css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    $("#Validate").css({'opacity': opacity});
                },
                duration: 500
            });

            setProgressBar(step);
            function setProgressBar(curStep){
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                .css("width",percent+"%")
            }

        }

    }
}
</script>