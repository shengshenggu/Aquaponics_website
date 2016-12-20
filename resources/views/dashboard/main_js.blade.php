<script>
var checked;   // 紀錄按鈕狀態
var count = 0; // 單純拿來判斷訊息多久之後消失
var clock;     // 當作鬧鐘, 一定時間就提醒使用者餵魚
var unit = 1000;  // 設定時間的單位 1000是秒, 60*1000是分, 60*60*1000是小時
var period = {{ $user->period }} * unit; // 紀錄使用者的週期

/**
 * 初始化
 */
$(document).ready(function(){
    checked = $('#switch').prop('checked');
    setInterval(getEnvironment,1000);
    if (checked) {
        /// 一開始如果按鈕是開啟時, 記得設定Crontab
        crontab('open');
    }
});

/**
 * 每秒去取得目前溫度與PH值
 * 按鈕開啟時, 會偵測環境資料是否超過使用者所設定的上下限
 * 按鈕關閉時, 關閉警告提醒
 */
function getEnvironment() {
    /// 呼叫Ajax去取得資料, 並判斷
    $.ajax({
        type: 'POST',
        url: '{{ url("/getEnvironment") }}',
        dataType: 'json',
        data: {
            _token: '{!! csrf_token() !!}',
        },
        success: function(jData) {
            if (checked) {
                if (jData.tmp > jData.tmp_max || jData.tmp < jData.tmp_min) {
                    environmentMessage('#tmp', 'error');
                } else {
                    environmentMessage('#tmp', 'success');
                }

                if (jData.ph > jData.ph_max || jData.ph < jData.ph_min) {
                    environmentMessage('#ph', 'error');
                } else {
                    environmentMessage('#ph', 'success');
                }
            }

            $("#switch").attr("checked",jData.status);
            $('#tmp').text('Temperature: ' + jData.tmp);
            $('#ph').text('pH: ' + jData.ph);
            //$('#period').text('提醒時間週期: ' + jData.period);
            $('#now').text('更新時間:' + Date('now'));
            period = jData.period * unit;
        },
        error: function(error) {
            $('body').html(error.responseText);
            setMessage('error', '取得溫度的Ajax 發生錯誤');
        }
    });

    /// 固定時間之後清除訊息
    if (count++ > 2) {
        setMessage();
    }
}

/**
 * 按鈕狀態改變時, 儲存狀態
 * 關閉Crontab
 */
function switch_change() {
    checked = $('#switch').prop('checked');

    /// 當按鈕關閉時, 溫度與PH顯示都恢復成正常顏色
    if (!checked) {
        environmentMessage('#tmp', 'success');
        environmentMessage('#ph', 'success');
        crontab('close');
    } else {
        crontab('open');
    }

    /// 並儲存按鈕狀態到資料庫中
    $.ajax({
        type: 'POST',
        url: '{{ url("/changeStatus") }}',
        dataType: 'json',
        data: {
            status: checked,
            _token: '{!! csrf_token() !!}',
        },
        success: function(jData) {
            if (jData.result)
                setMessage('success', '按鈕狀態變更成功');
            else
                setMessage('error', '按鈕狀態變更失敗');
        },
        error: function() {
            setMessage('error', '變更按鈕狀態的Ajax 發生錯誤');
        }
    });
}

/**
 * 設定Crontabl行程 (假的)
 * 其實是由JS的setInterval去做定期鬧鐘
 */
function crontab(status = '') {
    clearInterval(clock);
    if (status == 'open' && period != 0) {
        clock = setInterval(function(){
            window.alert('該餵魚囉~')
        }, period);
    }
}

/**
 * 當溫度或PH值有警告時, 呼叫此function以改變顯示顏色
 * 紅色代表超過上下限, 青色代表合理範圍
 */
function environmentMessage(id, status = '') {
    if (status == 'success') {
        $(id).addClass('w3-text-theme');
        $(id).removeClass('w3-text-red');
    } else if (status == 'error') {
        $(id).addClass('w3-text-red');
        $(id).removeClass('w3-text-theme');
    }
}

/**
 * 當使用ajax時, 成功或失敗都可以呼叫此function
 * 以顯示成功或錯誤訊息, 過數秒後消失
 */
function setMessage(status = '', message = '') {
    $('#other').text(message);
    if (status == 'success') {
        $('#other').addClass('w3-text-green');
        $('#other').removeClass('w3-text-red');
    } else if (status == 'error') {
        $('#other').addClass('w3-text-red');
        $('#other').removeClass('w3-text-green');
    } else {
        $('#other').removeClass('w3-text-red');
        $('#other').removeClass('w3-text-green');
    }
    count = 0;
}
</script>