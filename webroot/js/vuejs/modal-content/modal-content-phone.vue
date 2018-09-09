<template>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Couldn't add this phone, read details.</h4>
        </div>
        <div class="modal-body">
            <p v-if="loadingPhonesDetails.error">
                <alert type="danger">An error occurred during the loading of this page.
                    <button class="btn btn-primary" @click="loadingPhonesDetails.errorFunction">
                        Retry
                    </button>
                </alert>

            </p>
            <template v-else-if="phone">
            <div v-if="show">
                <div class="alert alert-warning">Couldn't add the phone it is not available.
                    <template v-if="(phone.transactions && phone.item_returns)
                                    && phone.transactions.length > phone.item_returns.length">
                        <p>The phone has been returned from a customer and <b>no return</b> was registered.</p>
                    </template>
                    <template v-else-if="(phone.transactions && phone.item_returns)
                              && phone.transactions.length < phone.item_returns.length">
                        <p>The phone has been registered as returned from a customer and yet <b>no transacation</b> was registered.</p>
                        <p>Add a transaction from the home page selecting an approximate transaction date.</p>
                        <p><b>Remember to copy the IMIEI first</b></p>
                        <btn @click="doCopy"
                             id="copy-button" @mouseover="isCopied = false"><i class="fas fa-copy"></i></btn>
                        <tooltip v-if="isCopied === false" :text="'Copy'" target="#copy-button"/>
                        <tooltip v-else-if="isCopied === true" :text="'Copied!'" target="#copy-button"/>
                        <tooltip v-else :text="'Copy with Ctrl + C'" target="#copy-button"/>
                    </template>
                </div>
                <p>Here is what you can do to solve the conflicts:</p>
                <btn href="/phones" target="_blank"
                     v-tooltip.right="'Will open a new tab'"
                     v-if="(phone.transactions && phone.item_returns)
                     && phone.transactions.length < phone.item_returns.length"type="primary">Go to home page</btn>

                <router-link v-else
                             class="btn btn-primary"
                             :to="'/consistency-check/'+id+'/add-return'">Add Phone return</router-link>
                <br><br>
            </div>
            <div class="alert alert-success" v-else>
                <p>It looks like we did it. Great buddy! Carry on.</p>
                <p>Now simply click on the button below to add it to the table:</p>
                <button type="button" class="btn btn-info" @click="addPhoneToList">Add to list</button>
            </div>
            <phones-table :phonesList="[phone]"></phones-table>
            <div class="well">Solving conflicts saves a lot of time to you and the administrator.
                Having a consistent database is just as having clean underwears. :P</div>
            </template>
            <div v-else>
                <p>Loading the content for you...</p>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="$router.push('/')" data-dismiss="modal">Cancel and exit</button>
            <button type="button" class="btn btn-primary" @click="addPhoneToList">Add to list</button>
        </div>
    </div>
</template>

<script>
    import phonesTable from '../phones-table.vue';
    export default {
        name: "modal-content-phone",
        props: ['id'],
        components: {
            phonesTable,
        },
        data: function() {
            return {
                loadingPhonesDetails: {
                    status: false,
                    error: null,
                    errorFunction: this.getPhoneDetails,
                },
                phone: null,
                show: false,
                isCopied: false,
            }
        },
        created: function() {
            this.getPhoneDetails();
        },
        watch: {
            'loadingPhonesDetails.error': function(newV, oldV) {
                if (newV)
                    this.errorDuringLoading();
            }
        },
        methods: {
            getPhoneDetails: function() {
                var vm = this;
                this.getPhoneDetailsAjax(this.id)
                    .then((resolve) => {
                        vm.phone = resolve.data.phone;
                        if (vm.phone && !vm.phone.is_phone_available)
                            vm.show = true;
                    })
                    .catch((error) => {
                        console.log("An error occurred while getting phone details" + error);
                        this.loadingPhonesDetails.error = error;
                    })
            },
            getPhoneDetailsAjax: function(id) {
                this.loadingPhonesDetails.error = null;
                return axios.get('phoneRecords/get-phone-details/' + id);
            },
            errorDuringLoading: function() {
                this.$notify({
                    type: 'danger',
                    title: 'Error during loading of phone data!',
                    content: 'It looks like that the internet connection might not be working.',
                });
            },
            addPhoneToList: function() {
                if (this.phone) {
                    this.$root.$data.imieiToAdd.value = this.phone.id;
                    eventHub.$emit('add-phone');
                    this.$router.push('/');
                }
            },
            doCopy: function () {
                let modal = this.$parent.$refs.modal;
                var vm = this;
                this.$copyText(vm.phone.imiei, modal).then(function (e) {
                    vm.$notify({type:'info', icon: 'fas fa-copy', title: 'IMIEI copied.'})
                    vm.isCopied = true;
                }, function (e) {
                    vm.$notify({type:'warning', icon: 'fas fa-copy', title: 'IMIEI could not be copied.',
                                 content: 'Press Ctrl + C now!'})
                    vm.isCopied = null;
                })
            }
        }
    }
</script>

<style scoped>

</style>