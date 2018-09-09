<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            data-backdrop='static' data-keyboard="false" id="modalPhoneDialog" ref="modal">
        <div class="modal-dialog" role="document">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>

    export default {
        name: "modal-phone-dialog",
        props: ['id'],
        data: function() {
            return {

            }
        },
        created: function() {

        },
        mounted: function () {
            $('#modalPhoneDialog').modal('show');
            this.$nextTick(function () {
                // Code that will run only after the
                // entire view has been rendered

            })
        },
        beforeRouteLeave: function(to, from, next) {
            $('#modalPhoneDialog').modal('hide');
            next()
        },
        methods: {
        }
    }
</script>

<style scoped>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>