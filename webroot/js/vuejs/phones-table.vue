<template>
    <div>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>IMIEI</th>
            <th>Description</th>
            <th>MISC</th>
            <th>Action</th>
        </tr>
        </thead>
        <template v-for="(phone, index) in phonesList">
        <phones-table-row-expandable>
            <template slot="row-to-expand" slot-scope="props">
                <td @click="props.expand" class="row-click">
                    <i class="fas fa-plus"></i> {{ phone.id }}
                </td>
                <td>{{ phone.imiei }}</td>
                <td>
                    <p>{{ phone.label }}</p>
                </td>
                <td><phones-status-icons v-bind:phone="phone"></phones-status-icons></td>
                <td>
                    <btn type="default" :href="'phones/view/' + phone.id" target="_blank">View</btn>
                    <btn type="danger" @click="deleteRow(phone)">Remove</btn>
                </td>
            </template>
            <template slot="expandable">
            <table class="table table-bordered table-hover">
                <tbody>
                <tr>
                    <th>Comments:</th>
                    <td>{{ phone.comments }}</td>
                </tr>
                <tr>
                    <th>Model:</th>
                    <td>{{ phone.model }}</td>
                </tr>
                <tr>
                    <th>OS version:</th>
                    <td>{{ phone.os_version }}</td>
                </tr>
                <tr>
                    <th>Supplier:</th>
                    <td>
                        <template v-if="phone.supplier && phone.supplier_order">
                            {{ phone.supplier.name }}({{ phone.supplier_order.invoice_date }})
                            <b>Invoice #: </b>{{phone.supplier_order.invoice_number}}
                        </template>
                    </td>
                </tr>
                <tr>
                    <th>Transactions:</th>
                    <td>
                        <table class="table table-bordered table-hover" v-if="phone.transactions.length">
                            <thead>
                                <tr>
                                <th>id</th>
                                <th>customer</th>
                                <th>date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="transaction in phone.transactions">
                                <td>{{transaction.id}}</td>
                                <td>{{transaction.customer.name}}</td>
                                <td>{{transaction.date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <h3>Repairs</h3>
            <table v-if="phone.repairs.length" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Comments</th>
                    <th>Created</th>
                    <th>Modified</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="repair in phone.repairs">
                    <td>{{repair.id}}</td>
                    <td>{{repair.reason}}</td>
                    <td>{{repair.status}}</td>
                    <td>{{repair.comments}}</td>
                    <td>{{repair.created}}</td>
                    <td>{{repair.modified}}</td>
                </tr>
                </tbody>
            </table>
            <alert type="info" v-else>0 Repairs</alert>
            <h3>Returns</h3>
            <table v-if="phone.item_returns.length" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Refund Amount</th>
                    <th>Comments</th>
                    <th>Created</th>
                    <th>Modified</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item_return in phone.item_returns">
                    <td>{{item_return.id}}</td>
                    <td>{{item_return.reason}}</td>
                    <td>{{item_return.status}}</td>
                    <td>{{item_return.refund}}</td>
                    <td>{{item_return.comments}}</td>
                    <td>{{item_return.created}}</td>
                    <td>{{item_return.modified}}</td>
                </tr>
                </tbody>
            </table>
                <alert type="info" v-else>0 Returns</alert>
            </template>
        </phones-table-row-expandable>
    </template>
    </table>
        <div v-if="loading">
            <div class="lds-ring-small"><div></div><div></div><div></div><div></div></div>
            <p> Loading new row...</p>
        </div>
        <div v-if="(!phonesList || phonesList.length === 0) && !loading">
            <p>No phone added.</p>
        </div>
    </div>
</template>

<script>
    import phonesStatusIcons from './phones-status-icons.vue'
    import phonesTableRowExpandable from './phones-table-row-expandable.vue'
    import slotScope from './slot-scope.vue'
    export default {
        name: "phones-table",
        components: {
            phonesStatusIcons,
            phonesTableRowExpandable,
            slotScope,
        },
        props: {
            phonesList: Array,
            loading: Boolean,
        },
        data: function() {
            return {
                showDetails: false,
            }
        },
        updated: function(){
            var vm = this;
            this.$nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })
        },
        methods: {
            deleteRow: function (phone) {
                this.$emit('delete-phone-record', phone);
            }
        }
    }
</script>

<style scoped>

</style>