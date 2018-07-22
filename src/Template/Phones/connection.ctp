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
    .disconnected-table {
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
                    <th v-for="key in columns">
                        {{key}}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="element in connected_data" :key="element.id">
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
                            <a target="_blank" :href="'/phones/connected/' + element.phone.id" class="btn btn-primary">
                            Edit
                            </a>
                        </td>
                    </template>
                </tr>
                </tbody>
            </table>
        </div>
    </template>
    <template id="table-disconnected-template">
        <div class="row disconnected-table table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th v-for="key in columns">
                    {{key}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="element in disconnected_data" :key="element.id">
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
                        <a target="_blank" :href="'/phones/connected/' + element.phone.id" class="btn btn-primary">
                            Edit
                        </a>
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
        </div>
    </template>


<div id="app">
    <div class="row">
        <div class="col-12">
            <h4>Connected phones</h4>
        </div>
    </div>
<connected-table
    :connected_data="connectedPhones"
    :columns="connectedPhonesColumns">
</connected-table>
    <div class="row">
        <div class="col-12">
            <h4>Disconnected phones</h4>
        </div>
    </div>
<disconnected-table
    :disconnected_data="disconnectedPhones"
    :columns="connectedPhonesColumns">
</disconnected-table>

</div>
<script>
    // const Vue = require('vue');

    Vue.component('connected-table', {
        props: {
            connected_data: Array,

            columns: Array
        },
        template: '#table-template'
    });
    Vue.component('disconnected-table', {
        props: {
            disconnected_data: Array,
            columns: Array
        },
        template: '#table-disconnected-template'
    });
    const app = new Vue({
        el: '#app',
        data: {
            connectedPhonesColumns: ['Status', 'IMIEI', 'Description', 'Conditions', 'Battery Status', 'Action'],
            connectedPhones: [{
                udid: '',
                status: '',
                phone: {

                },

            }],
            disconnectedPhones: [{
                udid: '',
                status: '',
                phone: {

                },

            }]
        },
        created() {
            this.connectedPhones = [];
            this.disconnectedPhones = [];
            this.setupStream();
        },
        methods: {
            setupStream() {
                // Not a real URL, just using for demo purposes
                let es = new EventSource('/phonesApi/stream');

                es.addEventListener('status', event => {
                    let data = JSON.parse(event.data);
                    let connected = data.connected;
                    let disconnected = data.disconnected;

                    // Get here the connected phones
                    connected.forEach((el, i) => {

                        let result = this.connectedPhones.findIndex(phone => {
                            return phone.udid === el.udid
                        });
                        console.log('let s see ' + el);
                        console.log(el);
                        if (result !== -1) {
                            console.log('Set new element ' + el);
                            Vue.set(this.connectedPhones, result, el)
                        }
                        else {
                            console.log('didnt work ' + el);
                            this.connectedPhones.push(el);
                        }
                    });

                    // Get the list of disconnected phones here
                    disconnected.forEach((el, i) => {
                        let result = this.connectedPhones.findIndex(phone => {
                            return phone.id === el.id
                        });
                        if (result !== -1) {
                            this.connectedPhones.splice(result, 1);
                            // Add only if it's not present there yet
                            let isPresent = this.disconnectedPhones.findIndex(phone => {
                                return phone.id === el.id
                            });
                            if (isPresent === -1)
                                this.disconnectedPhones.push(el);
                            else
                        //        If already present update it while you can
                                Vue.set(this.disconnectedPhones, isPresent, el);
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