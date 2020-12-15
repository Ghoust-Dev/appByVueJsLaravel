<template>
    <div> 
        <!-- progressbar -->
        <ul id="progressbar">
            <router-link to="/" id="1">
                <li class="active" id="personal"><strong>Personal</strong></li>
            </router-link>
            <router-link to="/company" id="2">
                <li  id="company"><strong>Company</strong></li>
            </router-link>
            <router-link to="/validate" id="3">
                <li  id="validate"><strong>Validate</strong></li>
            </router-link>
            <router-link to="/success" id="4">
                <li id="confirm"><strong>Finish</strong></li>
            </router-link>
        </ul>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div> 
    </div> 
</template>