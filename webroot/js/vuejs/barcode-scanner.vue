<template>

</template>

<script>
    export default {
        name: "barcode-scanner",
        data: function() {
            return {
                barcode: '',
            }
        },
        created: function() {
            this.$barcodeScanner.init(this.onBarcodeScanned);
        },
        destroyed: function () {
            // Remove listener when component is destroyed
            this.$barcodeScanner.destroy()
        },
        watch: {
            barcode: function(newB, oldB) {

            },
        },
        methods: {
            onBarcodeScanned: function(barcode) {
                this.barcode = barcode.replace("$", '');
                this.validateIMIEI();
            },
            validateIMIEI: function() {
                if (this.barcode.length === 15 && this.barcode.match(/^[0-9]+$/)) {
                    this.$emit('imiei-scanned', this.barcode);
                    var audio = new Audio('../../sounds/quite-impressed.wav');
                    audio.play();
                    this.$notify({type: 'info', title:'You just scanned an IMIEI', icon: 'fas fa-barcode'});
                }
                else
                    this.$notify({type: 'danger', title:'Barcode not recognized please scan again.'})
            }
        }
    }
</script>

<style scoped>

</style>