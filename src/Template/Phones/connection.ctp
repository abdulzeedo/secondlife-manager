<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone $phone
 */
?>
<!--Add vue-->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<br><br><br>
<style>
    .connection-table {

    }
    .disconnected-table table{
        color: black;
        background-color: lightgrey;
        border-color: black;
    }
    .small-text {
        font-size: .8rem;
    }
</style>


    <template id="table-template">
        <div class="row connection-table table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="6">{{connected_data.user_name}}</th>
                </tr>
                <tr>
                    <th v-for="key in columns">
                        {{key}}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="element in connected_data.phones" :key="element.id">
                    <td>{{element.status}}</td>
                    <template v-if="element.phone">
                        <td>{{element.phone.imiei}}
                            <div class="small-text">{{element.udid}}</div>
                        </td>
                        <td>{{element.phone.label}}</td>
                        <td :class="{info: !element.phone.grade || element.phone.grade == '',
                                     info: !element.phone.status || element.phone.status == ''}">
                            <b>Grade: </b>{{element.phone.grade}}<br>
                            <b>Status: </b>{{element.phone.status}}
                        </td>
                        <td :class="[element.phone.battery_health < 65 ? 'danger'
                                    : [element.phone.battery_health < 75 ? 'warning'
                                    : 'success']]">
                            <b>Health: </b>{{element.phone.battery_health}}<br>
                            <b>Cycles: </b>{{element.phone.battery_cycles}}</td>
                        <td>
                            <a href="#" v-on:click="openNewTab(element.phone.id)" class="btn btn-primary">
                                Edit
                            </a>
                        </td>
                    </template>
                </tr>
                </tbody>
            </table>
        </div>
    </template>


<div class="container-fluid">
    <div id="app">
        <div class="row">
            <div class="col-12">
                <h4>Connected phones</h4>
            </div>
        </div>
        <connected-table
            v-for="user in connectedPhones" :key="user.user_id"
            :connected_data="user"
            :columns="connectedPhonesColumns"
        >
        </connected-table>
        <div class="row">
            <div class="col-12">
                <h4>Disconnected phones</h4>
            </div>
        </div>
        <div class="disconnected-table">
            <connected-table
                    v-for="user in disconnectedPhones" :key="user.user_id"
                    :connected_data="user"
                    :columns="connectedPhonesColumns">
            </connected-table>
        </div>
    </div>
</div>
<script>
    // const Vue = require('vue');

    Vue.component('connected-table', {
        props: {
            connected_data: Object,
            columns: Array
        },
        methods: {
            openNewTab(id) {
                window.open('/phones/connected/' + id, 'editTab')
            }
        },
        template: '#table-template'
    });
    const app = new Vue({
        el: '#app',
        data: {
            connectedPhonesColumns: ['Status', 'IMIEI', 'Description', 'Conditions', 'Battery Status', 'Action'],
            connectedPhones: [{
                user_id: '',
                user_name: '',
                phones: [{
                    udid: '',
                    status: '',
                    phone: {},

                }],
            }],
            disconnectedPhones: [{
                user_id: '',
                user_name: '',
                phones: [{
                    udid: '',
                    status: '',
                    phone: {},
                    phone_id: '',


                }],
            }],
        },
        created() {
            this.connectedPhones = [];
            this.disconnectedPhones = [];
            this.requestPermission();
            this.setupStream();
        },
        methods: {
            requestPermission() {
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
            },
            notifyMe() {
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notification = new Notification('New Phone added', {
                        icon: 'https://cdn4.iconfinder.com/data/icons/simple-device/300/flat-iphone-512.png',
                        body: "A new phone has been connected!",
                    });

                    notification.onclick = function () {
                        let id = this.getCurrentID();
                        let url = "https://mobile.sellmobilefast.co.uk/phones/connection";
                        if (parseInt(id))
                            url += '/' + id;
                        window.open("url", 'connectionTab');
                    };

                }
            },
            getCurrentID() {
                var currentPageURL = window.location.pathname;
                var id = currentPageURL.substring(currentPageURL.lastIndexOf('/') + 1);
                return id;
            },
            setupStream() {
                // Not a real URL, just using for demo purposes

                // Get user id if exists

                var id = this.getCurrentID();
                var streamURL = "/phonesApi/stream";
                // If it's an int, it's an ID for sure
                if (parseInt(id)) {
                    streamURL += '/' + id;
                }

                let es = new EventSource(streamURL);

                es.addEventListener('status', event => {
                    let data = JSON.parse(event.data);
                    let connected = data.connected;
                    let disconnected = data.disconnected;

                    // Get here the connected phones
                    connected.forEach((el, i) => {

                        let userTableIndex = this.connectedPhones.findIndex(user => {
                            return user.user_id === el.user_id
                        });

                        // If there exists a table look for the phone row
                        if (userTableIndex !== -1) {

                            let result = this.connectedPhones[userTableIndex].phones.findIndex(phone => {
                                return phone.udid === el.udid
                            });
                            if (result !== -1) {
                                Vue.set(this.connectedPhones[userTableIndex].phones, result, el)
                            }
                            else {
                                this.notifyMe();
                                this.connectedPhones[userTableIndex].phones.push(el);
                            }
                        }
                        // Else just create a new user object and push it to the
                        // the react array
                        else {
                            var user = {
                                user_id: el.user_id,
                                user_name: el.user.email,
                                phones: [el]
                            };

                            this.notifyMe();
                            this.connectedPhones.push(user);
                        }

                    });

                    var addDisconnectedPhoneRow = (toAddTo, phone) => {
                        if (phone.phone) {
                            toAddTo.push(phone);
                        }
                    };
                    // Get the list of disconnected phones here
                    disconnected.forEach((el, i) => {
                        // Get connected user table index for the phone's user
                        let userConnTableIndex = this.connectedPhones.findIndex(user => {
                            return user.user_id === el.user_id
                        });

                        // Get disconnected user table index for the phone's user
                        var userDisconnTableIndex = this.disconnectedPhones.findIndex(user => {
                            return user.user_id === el.user_id
                        });
                        // If the disconnected table doesn't exist for user create it
                        if (userDisconnTableIndex === -1) {
                            var user = {
                                user_id: el.user_id,
                                user_name: el.user.email,
                                phones: []
                            };

                            // Create table
                            this.disconnectedPhones.push(user);

                            // Get its index
                            userDisconnTableIndex = this.disconnectedPhones.findIndex(user => {
                                return user.user_id === el.user_id
                            });
                        }

                        // If there exists a connected user table look for the phone row
                        //      if the phone is in the connected user table
                        //          - Remove it from there and add it in disconnected user table

                        /**
                         * -1: if there is no phone row in connected user table or if there is no
                         *      user connected table
                         * int: (>= 0) if there is a phone row in connected user table
                        */
                        var isInUserConnTable = -1;
                        if (userConnTableIndex !== -1) {
                            isInUserConnTable = this.connectedPhones[userConnTableIndex].phones.findIndex(phone => {
                                return phone.id === el.id
                            });
                        }
                        // If the phone is in the connected list
                        // - Remove it from there
                        // - Add it in disconnected
                        if (isInUserConnTable !== -1) {
                            this.connectedPhones[userConnTableIndex].phones.splice(isInUserConnTable, 1);
                            addDisconnectedPhoneRow(this.disconnectedPhones[userDisconnTableIndex].phones, el);
                            // this.disconnectedPhones[userDisconnTableIndex].phones.push(el);
                        }
                        // If the phone is not in the connected list
                        // but is in the disconnected list, update its status
                        // for every row (so duplicates as well).
                       else {
                            // Add only if same ID is not present
                            let isPresent =
                                this.disconnectedPhones[userDisconnTableIndex].phones.findIndex(phone => {
                                    return phone.id === el.id
                                });
                            if (isPresent === -1) {
                                addDisconnectedPhoneRow(this.disconnectedPhones[userDisconnTableIndex].phones, el);
                                // this.disconnectedPhones[userDisconnTableIndex].phones.push(el);
                            }


                            // Update all the phones with current udid
                            let isPresentForUpdate = this.disconnectedPhones[userDisconnTableIndex].phones.findIndex(phone => {
                                return phone.udid === el.udid
                            });
                                // Loop through phones and update all phones having same udid
                                if (isPresentForUpdate !== -1) {
                                    this.disconnectedPhones[userDisconnTableIndex].phones.forEach((phone, i) => {
                                       if (phone.udid === el.udid) {
                                           this.disconnectedPhones[userDisconnTableIndex].phones[i].phone = el.phone;
                                       }
                                    });
                                }
                            }


                    });

                }, false);
                es.addEventListener('open', function(e) {
                    console.log('connection opened')
                }, false);

                es.addEventListener('error', event => {
                    var txt;
                    switch( event.target.readyState ){
                        // if reconnecting
                        case EventSource.CONNECTING:
                            txt = 'Reconnecting...';
                            break;
                        // if error was fatal
                        case EventSource.CLOSED:
                            txt = 'Connection failed. Will not retry.';
                            break;
                    }
                    console.log(txt);
                }, false);
            }
        }
    });


</script>