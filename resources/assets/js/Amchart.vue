<template>
    <div :name="env">
        <div class="w3-display-middle" v-if="loading" style="position:fixed"><i
                class="fa fa-spinner fa-spin w3-text-teal w3-jumbo"></i></div>
        <div class="w3-jumbo w3-text-red w3-center">{{ error }}</div>
        <div :id="env" style="width: 100%; height: 400px; background-color: #FFFFFF;"></div>
    </div>
</template>

<script>

    export default {
        mounted: function () {
            this.fetchData(this);
            // this.showAm(this);
        },
        data () {
            return {
                result: [],
                plantname: '',
                loading: true,
                error : ''
            }
        },
        watch: {
            period: function () {
                this.loading = true;
                this.fetchData(this);
            },
            plant: function () {
                this.loading = true;
                this.fetchData(this);
            }
        },
        methods: {
            fetchData: function (vm) {
//                var str = "In amchart: \n" + "env: " + vm.env + "\nperiod: " + vm.period + "\nplant: " + vm.plant + "\nuser: " + vm.user + "\nshare: " + vm.share;
//                console.log(str);

                if (this.plant != -1) {
                    $.ajax({
                        url: vm.url + '/getEnvData?plant_id=' + vm.plant + '&period=' + vm.period + '&env=' + vm.env + '&share=' + vm.share + '&user=' + vm.user,
                        dataType: 'json',
                        success: function (jData) {
                            if (jData.result == 'ok') {
                                vm.result = jData.ret;
                                vm.plantname = jData.plantname;
                                // console.log(vm.result);
                            } else {
                                vm.result = {};
                            }
                            vm.showAm(vm);
                        },
                        error: function (e) {
                            console.log(e.responseText);
                            vm.error = 'Communication Failed, Informate Administrator'
                        },
                        complete: function () {
                            vm.loading = false;
                        }
                    });
                }
            }
        },
        props: ['url', 'env', 'plant', 'period', 'share', 'user', 'showAm']
    }
</script>