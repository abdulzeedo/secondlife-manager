<template>
    <div>
        <span :class="[phone.icloud_status == 0 ? 'green-status-icon'
                                    : 'red-status-icon', 'fas fa-cloud']"
              data-toggle="tooltip" data-placement="bottom"
              :title="'iCloud ' + phone.icloud_status_label"></span>
        <span :class="[phone.sim_lock_status === 'unlocked' ? 'green-status-icon'
                                    : 'red-status-icon', 'fas fas fa-signal']"
              data-toggle="tooltip" data-placement="bottom"
              :title="'Sim ' + phone.sim_lock_status"></span>
        <span :class="[phone.touch_id_status == 0 ? 'green-status-icon'
                                    : 'red-status-icon', 'fas fa-fingerprint']"
              data-toggle="tooltip" data-placement="bottom"
              :title="'Touch ID ' + phone.touch_id_status_label"></span>
        <span :class="[phone.is_phone_available ? 'unknown-status-icon'
                                    : 'green-status-icon', 'fas fa-dollar-sign']"
              data-toggle="tooltip" data-placement="bottom"
              :title="phone.is_phone_available ? 'Phone Available' : 'Phone not Available'"></span>
        <span :class="[phone.item_returns.length ? 'yellow-status-icon'
                                    : 'unknown-status-icon', 'fas fa-undo-alt']"
              data-toggle="tooltip" data-placement="bottom"
              :title="phone.item_returns.length + ' Returns'"></span>
        <span  v-if="phone.item_returns.length" class="status-icon-badge">{{phone.item_returns.length}}</span>
        <span :class="[phone.repairs.length ? 'yellow-status-icon'
                                    : 'unknown-status-icon', 'fas fa-screwdriver']"
              data-toggle="tooltip" data-placement="bottom"
              :title="phone.repairs.length + ' Repairs'"></span>
        <span  v-if="phone.repairs.length" class="status-icon-badge">{{phone.repairs.length}}</span>
    </div>
</template>

<script>
    export default {
        name: "phones-status-icons",
        props: {
            phone: Object,
        },
    }
</script>

<style scoped>

</style>