import Vue from 'vue'
import VueRouter from 'vue-router'
import imieiAutocomplete from './imiei-autocomplete.vue';
import phonesTable from "./phones-table.vue";
import axios from 'axios';
import modalNewPhone from './modal-new-phone.vue';
import modalPhoneDialog from './modal-phone-dialog.vue';
import * as uiv from 'uiv'
import routes from './routes.js';
import VueBarcodeScanner from 'vue-barcode-scanner'
import barcodeScanner from './barcode-scanner.vue';
import VueClipboard from 'vue-clipboard2'



axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let options = {
    sound: false, // default is false
    soundSrc: '../../sounds/quite-impressed.wav', // default is blank
    sensitivity: 300, // default is 100
}

Vue.use(VueBarcodeScanner, options);
Vue.use(uiv);
Vue.use(VueRouter);
VueClipboard.config.autoSetContainer = true;
Vue.use(VueClipboard);
var oldNotfiy = Vue.prototype.$notify;
Vue.prototype.$notify = function(options, cb) {
    oldNotfiy(options, cb);
    if (options.type && options.type === 'danger') {
        var audio = new Audio('../../sounds/to-the-point.wav');
        audio.play();
    }
};

window.axios = axios;
window.Vue = Vue;
const router = new VueRouter({
    routes
});

window.eventHub = new Vue({
    data: {
        openAddNewPhoneModal: false,
    }
});

var vm = new Vue({
    router,
    components: {
        imieiAutocomplete,
        phonesTable,
        modalNewPhone,
        modalPhoneDialog,
        barcodeScanner,
    },
    el: '#app',
    data: {
        newImieiToAdd: '',
        imieiToAdd: '',
        phonesList: [],
        loadingPhonesDetails: false,
        loadingPhoneRow: false,
        currentImiei: '',
        phoneWithProblems: {
            modalID: 'modalPhoneDialog',
            phone: '',

        },
        user_id,
        imieiScanPhoneAddLoading: false,

    },
    created: function() {
        eventHub.$on('add-phone', this.addPhone);

        this.getPhoneRecords();
    },
    beforeDestroy: function() {
        eventHub.$off('add-phone', this.addPhone);
    },
    methods: {
        removeFocus: function(e) {
            console.log(e);
            e.target.blur();
        },
        imieiChanged: function(imiei) {
            this.newImieiToAdd = '';
            this.imieiToAdd = '';
            this.currentImiei = imiei;
        },
        imieiSelected: function(imiei) {
            this.imieiToAdd = imiei;
        },
        addNewImiei: function(imiei) {
            this.newImieiToAdd = imiei;
        },
        addNewPhone: function() {
            this.openAddNewPhoneModal = true;
        },
        newPhoneSubmit: function() {
            var vm = this;
            return this.newPhoneSubmitAjax(vm.newImieiToAdd)
                .then((resolve) => {
                    console.log(resolve);
                    var phone = resolve.data.response.success.phone;
                    vm.imieiToAdd = {value: phone.id};
                    this.$notify({
                        type: 'success',
                        title: 'Phone added to database.',
                    });
                    vm.addPhone();
                    return phone;
                }, (error) => {
                    if (error.response.data.response.error.phone.imiei.unique) {
                        console.log(error.response.data.response.error.phone.imiei.unique)
                        vm.$notify({title: 'The Phone is already in the database.', type:'danger'});
                    }
                    else if (error.response.status == 400) {
                        console.log(error.response.data.response.error.message)
                        vm.$notify({title: 'The Phone could not be added. Retry.', type:'danger'});
                    }
                    console.log('Could not add Phone using ajax' + error.message)
                })
                .catch((error) => {
                    console.log('Could not add Phone. The whole process went wrong.' + error)
                    vm.$notify({title: 'Could not add Phone. The whole process went wrong. ',
                        content: error.message,
                        type:'danger'});
                })
        },
        newPhoneSubmitAjax: function(imiei) {
              return axios.post('/phoneRecords/add-phone', {
                  imiei: imiei,
                  serial_number: imiei,
              }, {responseType: 'json'});
        },
        addPhone: function () {
            var vm = this;
            console.log('Iphone has been called');
            if (this.imieiToAdd && this.imieiToAdd.value) {

                return this.getPhoneDetails(this.imieiToAdd.value)
                    .then((phone) => {
                        if (this.guaranteeAvailability(phone)) {
                            vm.loadingPhonesDetails = true;
                            vm.loadingPhoneRow = true;
                            this.addPhoneAjax(phone)
                                .then((resolve) => {
                                    var phoneRecord = resolve.data.response.success.phoneRecord;
                                    phone.phoneRecordId = phoneRecord.id;
                                    vm.$notify({
                                        type: 'success',
                                        title: 'Phone added to table.',
                                    });
                                    vm.loadingPhonesDetails = false;
                                    vm.loadingPhoneRow = false;
                                    return this.phonesList.push(phone);
                                })
                                .catch((error) => {
                                    console.log(error.response.data);
                                    if (error.response.status == 400) {
                                        console.log(error.response.data.response.error.message)
                                        vm.$notify({title: 'The Phone could not be saved. Retry.', type:'danger'});
                                    }
                                    else if (error.response.status == 409) {
                                        console.log(error.response.data.response.error.message)
                                        console.log(error.response);
                                        console.log(phone);
                                        vm.$notify({title: 'The Phone is already in the list.', type:'danger'});
                                    }
                                    vm.loadingPhonesDetails = false;
                                    vm.loadingPhoneRow = false;
                                    console.log('Could not add Phone using ajax' + error.message)
                                });
                        }
                    })
                    .catch((error) => {
                        console.log('Could not add Phone. The whole process went wrong.' + error)
                        vm.$notify({title: 'Could not add Phone. The whole process went wrong. ',
                            content: error.message,
                            type:'danger'});
                        vm.loadingPhonesDetails = false;
                        vm.loadingPhoneRow = false;
                    })
            }
        },
        getPhoneListIndex: function(phone) {
            return this.phonesList.findIndex(phoneL => {
                return phoneL.id === phone.id;
            });
        },
        deletePhone: function (phone) {
            var vm = this;
            this.$confirm({
                title: 'Confirm',
                content: 'This phone will be permanently deleted are you sure?'
            })
                .then(() => {
                    vm.deletePhoneAjax(phone)
                        .then(({data}) => {
                            console.log(data);
                            vm.phonesList.splice(vm.getPhoneListIndex(phone), 1);
                            vm.$notify({title: 'Phone deleted successfully.', type:'success'});
                        })
                        .catch(({response, message, request}) => {
                            console.log('Could not delete Phone using ajax. ' + message)
                            if (response.status === 400) {
                                console.log(response.data.response.error.message);
                                vm.$notify({title: response.data.response.error.message, type:'danger'});
                            }
                            console.log('Could not delete Phone using ajax. ' + message)
                        })
                        .catch((error) => {
                            console.log('Could not delete Phone. The whole process went wrong. ' + error)
                            vm.$notify({title: 'Could not delete Phone. The whole process went wrong. ',
                                        content: error.message,
                                        type:'danger'});
                        })
                })
                .catch(() => {
                    this.$notify('Delete canceled.')
                })

        },
        deletePhoneAjax: function(phone) {
            return axios.post('/phoneRecords/delete', {
                id: phone.phoneRecordId,
                item_id: phone.id,
            }, {responseType: 'json'})
        },
        addPhoneAjax: function(phone) {
            console.log(phone);
            return axios.post('/phoneRecords/add', {
                user_id: this.user_id,
                item_id: phone.id,
            }, {responseType: 'json'})
        },
        getPhoneDetails: function(id) {
            this.loadingPhonesDetails = true;
            return axios.get('phoneRecords/get-phone-details/' + id)
                .then((resolve) => {
                    return resolve.data.phone;
                })
                .catch((error) => {
                    console.log("An error occurred when getting phone details" + error);
                    this.loadingPhonesDetails = false;
                })
                .finally(() => {
                    this.loadingPhonesDetails = false;
                })
        },
        guaranteeAvailability: function(phone) {
            if (phone.is_phone_available !== true) {
                this.phoneWithProblems.phone = phone;
                this.$router.push({name: 'modal-content-phone', params: {id: phone.id}});
                return false;
            }
            return true;

        },
        getPhoneRecords: function() {
            var vm = this;
            this.loadingPhoneRow = true;
            this.getPhoneRecordsAjax()
                .then((resolve) => {
                    var phoneRecords = resolve.data.phoneRecords;
                    phoneRecords.forEach((record) => {
                        vm.phonesList.push(record.phone);
                    })
                    vm.loadingPhoneRow = false;
                })
                .catch((error) => {
                    console.log("Could not get all phone records" + error.message);
                    vm.loadingPhoneRow = false;
                })
        },
        getPhoneRecordsAjax: function() {
            return axios.get('/phoneRecords/view-all', {responseType: 'json'})
        },
        onImieiScanned: function(imiei) {
            var vm = this;
            var isVisible = $('.modal').is(':visible');
            if (isVisible)
                return;
            axios.get('/phoneRecords/imiei-list/' + imiei)
                .then((response) => {
                    return response.data.phonesList;
                })
                .then((imieiList) => {
                    /**
                     * This means that the imiei is not present in DB
                     */
                    var isResultEmpty = imieiList.length === 0;

                    if (isResultEmpty) {
                        vm.$confirm({
                            title: 'Not registered',
                            content: `Would you like to create a new Phone entry on the fly? I 
                                        guarantee you that it will take seconds.`
                        }).then(() => {
                            vm.newImieiToAdd = imiei;
                            eventHub.$emit('add-new-phone-open-modal');
                        })
                    } else if(imieiList.length === 1){
                        vm.imieiToAdd = imieiList[0];
                        vm.imieiScanPhoneAddLoading = true;
                        console.log('calling add Phone from here');
                        vm.addPhone()
                            .then(() => {
                                vm.imieiScanPhoneAddLoading = false;
                            })
                            .catch(() => {
                                vm.imieiScanPhoneAddLoading = false;
                            })
                    }
                })
                .catch((error) => {
                    console.log('An error occurred while loading imiei list' + error);
                    this.$notify({title: 'An error occurred while loading imiei list', type: 'danger'});
                    return false;
                })
        }
    }
});