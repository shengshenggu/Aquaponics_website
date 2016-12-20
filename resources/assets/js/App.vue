<template>
    <div>
        <div class="w3-row-padding  w3-center">
            <div class="w3-half">
                <select class="w3-select w3-round w3-border w3-center w3-pale-green" v-model="selectedPlant">
                    <option value="-1" disabled>請選擇植物</option>
                    <option v-for="plant in plants" :value="plant.id">{{ plant.plantname }}</option>
                </select>
            </div>

            <div class="w3-half w3-pale-blue">
                <label for="">時段</label>
                <input class="w3-radio" type="radio" name="period" value="30" v-model="selectedPeriod">
                <label class="w3-validate">All Time</label>
                <input class="w3-radio" type="radio" name="period" value="24" v-model="selectedPeriod">
                <label class="w3-validate">Recent 24HR</label>
            </div>
        </div>

        <Amchart v-if="selectedPlant != -1" v-for="env in environments" :url="url" :env="env" :period="selectedPeriod"
                 :share="share" :plant="selectedPlant" :user="user === null ? null : user.id "
                 :showAm="hourlyData"></Amchart>
    </div>
</template>

<script>
    import Amchart from './Amchart.vue'
    export default {
        data: function () {
            return {
                selectedPlant: -1,
                selectedPeriod: '30',
                environments: ['pH', 'temp', 'light', 'water', 'ndvi'],
                plants: null,
                user: null
            }
        },
        props: ['url', 'myplants', 'share', 'myuser'],
        components: {
            'Amchart': Amchart
        },
        methods: {
            show: function () {
                console.log("period: " + this.selectedPeriod + ", plant: " + this.selectedPlant + ", user: " + this.user);
            },
            hourlyData: function (vm) {
                var dateFormat = "YYYY-MM-DD HH";
                var category = {
                    "parseDates": true,
                    "minPeriod": "hh"
                };

                if(vm.period == '24') {
                    dateFormat = "YYYY-MM-DD HH";
                    category = {
                        "parseDates": true,
                        "minPeriod": "hh"
                    };
                }

                var title = 'All Time';
                if (vm.period == '24') {
                    title = 'Recent 24HR';
                }

                console.log(vm.env);
                AmCharts.makeChart(vm.env,
                    {
                        "type": "serial",
                        "categoryField": "date",
                        "dataDateFormat": dateFormat,
                        "categoryAxis": category,
                        "chartCursor": {
                            "enabled": true
                        },
                        "chartScrollbar": {
                            "enabled": true
                        },
                        "trendLines": [],
                        "graphs": [
                            {
                                "bullet": "square",
                                "id": "AmGraph-1",
                                "title": vm.env,
                                "valueField": 'record'
                            },
                            {
                                "bullet": "round",
                                "id": "AmGraph-2",
                                "title": 'max',
                                "valueField": 'max'
                            },
                            {
                                "bullet": "round",
                                "id": "AmGraph-3",
                                "title": 'min',
                                "valueField": 'min'
                            }
                        ],
                        "guides": [],
                        "valueAxes": [
                            {
                                "id": "ValueAxis-1",
                                "title": "環境值"
                            }
                        ],
                        "allLabels": [],
                        "balloon": {},
                        "legend": {
                            "enabled": true,
                            "useGraphSettings": true
                        },
                        "titles": [
                            {
                                "id": "Title-1",
                                "size": 15,
                                "text": vm.env + " － " + vm.plantname + ' - ' + title
                            }
                        ],
                        "dataProvider": vm.result
                    });
            }
        },
        created: function () {
            this.plants = JSON.parse(this.myplants);
            this.user = JSON.parse(this.myuser);

            // console.log(this.plants);
            // console.log('share: ' + this.share);
            // console.log(this.user);
            // console.log(this.url);

            if (this.share == 1) {
                this.selectedPlant = this.plants[0].id;
                console.log('plant: ' + this.selectedPlant);
            }
        }
    }
</script>
