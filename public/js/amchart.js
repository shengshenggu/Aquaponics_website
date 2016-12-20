var data = [];
var env = '';
var user = '';
var plant_name = '';
var plant = null;
var period = '';
var method = null;

function dailyData(pp) {
	AmCharts.makeChart(pp,
	{
	"type": "serial",
	"categoryField": "date",
	"dataDateFormat": "YYYY-MM-DD",
	"categoryAxis": {
		"parseDates": true
	},
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
			"title": env,
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
			"text": plant_name + " - 30 Days" + (user=='' ? "" : " by " + user)
		}
	],
	"dataProvider": data
	});
}

function hourlyData(pp) {
AmCharts.makeChart(pp,
{
	"type": "serial",
	"categoryField": "date",
	"dataDateFormat": "YYYY-MM-DD HH:mm",
	"theme": "black",
	"categoryAxis": {
		"minPeriod": "hh",
		"parseDates": true
	},
	"chartCursor": {
		"enabled": true,
		"categoryBalloonDateFormat": "JJ:NN"
	},
	"chartScrollbar": {
		"enabled": true
	},
	"trendLines": [],
	"graphs": [
		{
			"bullet": "square",
			"id": "AmGraph-1",
			"title": env,
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
			"text": plant_name + " - 24HR" + (user=='' ? "" : " by " + user)
		}
	],
	"dataProvider": data
});
}

function changePeriod(p) {
	switch(p)
	{
		case '30':
			method = dailyData;
			break;
		case '24':
			method = hourlyData;
			break;
	}
	period = p;
	callAjax();
}

/**
 * 
 */ 
function showData(param) {
	env = param;
	callAjax();
}

/**
 * 當使用者點擊植物時, 呼叫Ajax取得植物資訊
 */ 
function showPlant(id) {
	plant = id;
	callAjax();
}

/**
 * 網頁初始化
 */
$('document').ready(function(){
	user = $('#user').val();
	plant = $('#myPlant').val()
	env = $('input[name="environment"]:checked').val();
	changePeriod($('input[name="period"]:checked').val());
});