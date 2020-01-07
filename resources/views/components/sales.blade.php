<div>
    <div class="card-title m-2">
        <i class="fi-menu"></i> 매출 통계표
        <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allLank" aria-expanded="true" aria-controls="allLank">
          <i class="dripicons-chevron-down"></i>
        </button>
    </div>
</div>

<div class="dragbox_hover collapse show p-3" id="allLank">
	<!-- 기간조회 -->
	<div class="card-title col-md-12">
	  <div class="row justify-content-md-center mb-5">

		<div class="col-md-9">
		  <div class="input-group">
			<div class="input-group-prepend">
			  <span class="input-group-text">통계기간</span>
			</div>
			<input type="text" id="start_date_table" name="start_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
			<div class="input-group-append">
			  <span class="input-group-text">부터</span>
			</div>
			<input type="text" id="end_date_table" name="end_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
			<div class="input-group-append">
			  <span class="input-group-text">까지</span>
			</div>
			<div class="input-group-append">
			  <span class="input-group-text">
				<a href="javascript:void(0)" onclick="stat_tableDateTerm(7)">일주일</a>
			  </span>
			</div>
			<div class="input-group-append">
			  <span class="input-group-text">
				<a href="javascript:void(0)" onclick="stat_tableDateTerm(30)">1개월</a>
			  </span>
			</div>
			<div class="input-group-append">
			  <span class="input-group-text">
				<a href="javascript:void(0)" onclick="stat_tableDateTerm(90)">3개월</a>
			  </span>
			</div>
			<div class="input-group-append">
			  <span class="input-group-text">
				<a href="javascript:void(0)" onclick="stat_tableDateTerm(180)">6개월</a>
			  </span>
			</div>
			<div class="input-group-append">
			  <span class="input-group-text">
				<!-- <a href="javascript:void(0)" onclick="showEntireTable(day1, day2)"><i class="entypo-chart-bar"></i>보기</a> -->
				<a href="javascript:void(0)" onclick="showSalesTable()"><i class="entypo-chart-bar"></i>보기</a>
			  </span>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!-- 기간조회 End -->

    <!-- 매출 통계 표 -->
    <div class="table-responsive">
      <table class="table table-bordered">
      <thead>
        <tr>
            <th colspan="2" rowspan="2">구분</th>
            <th colspan="3" id="this">이번 주</th> <th colspan="3" id="last">지난 주</th> <th colspan="3">증감수</th>
        </tr>
        <tr>
            <th>전체</th> <th>유료</th> <th>무료</th>
            <th>전체</th> <th>유료</th> <th>무료</th>
            <th>전체</th> <th>유료</th> <th>무료</th>
        </tr>
        <tr>
            <th rowspan="5" style="vertical-align: middle">이용수</th>
            <th>플랫폼</th>
            <td id="thisWeekTotalPf"></td> <td id="thisWeekPaidPf"></td> <td id="thisWeekFreePf"></td>
            <td id="lastWeekTotalPf"></td> <td id="lastWeekPaidPf"></td> <td id="lastWeekFreePf"></td>
            <td id="variTotalPf"></td>     <td id="variPaidPf"></td>     <td id="variFreePf"></td>
        </tr>
        <tr>
            <th>푸쉬자동화</th>
            <td id="thisWeekTotalPa"></td> <td id="thisWeekPaidPa"></td> <td id="thisWeekFreePa"></td>
            <td id="lastWeekTotalPa"></td> <td id="lastWeekPaidPa"></td> <td id="lastWeekFreePa"></td>
            <td id="variTotalPa"></td>     <td id="variPaidPa"></td>     <td id="variFreePa"></td>
        </tr>
        <tr>
            <th>MA통합</th>
            <td id="thisWeekTotalMi"></td> <td id="thisWeekPaidMi"></td> <td id="thisWeekFreeMi"></td>
            <td id="lastWeekTotalMi"></td> <td id="lastWeekPaidMi"></td> <td id="lastWeekFreeMi"></td>
            <td id="variTotalMi"></td>     <td id="variPaidMi"></td>     <td id="variFreeMi"></td>
        </tr>
		<tr>
            <th>리타겟팅</th>
            <td id="thisWeekTotalRt"></td> <td id="thisWeekPaidRt"></td> <td id="thisWeekFreeRt"></td>
            <td id="lastWeekTotalRt"></td> <td id="lastWeekPaidRt"></td> <td id="lastWeekFreeRt"></td>
            <td id="variTotalRt"></td>     <td id="variPaidRt"></td>     <td id="variFreeRt"></td>
        </tr>
		<tr>
            <th>마케팅오토메이션</th>
            <td id="thisWeekTotalMa"></td> <td id="thisWeekPaidMa"></td> <td id="thisWeekFreeMa"></td>
            <td id="lastWeekTotalMa"></td> <td id="lastWeekPaidMa"></td> <td id="lastWeekFreeMa"></td>
            <td id="variTotalMa"></td>     <td id="variPaidMa"></td>     <td id="variFreeMa"></td>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
</div>

@section('script')
<script>
$(document).ready(function() {
  // 기본 표 출력
  platformData();
});

// 입력한 날짜 간 기간계산
function getTerm() {
  var start_date = $('#start_date_table').val();
  var end_date = $('#end_date_table').val();
  var diff = new Date(Date.parse(end_date) - Date.parse(start_date));

  return Math.round(diff/1000/60/60/24);
}

// 표 출력하는 부분
function showSalesTable() {
  var start_date = $('#start_date_table').val();
  var end_date = $('#end_date_table').val();

  var term = getTerm();
  //alert(term);

  // 지난 시작일: 지난 종료일에서 term만큼 뒤로 간 날짜
  // 지난 종료일: 이번 시작일보다 하루 전 날
  var last_start = new Date(start_date);
  var last_end = new Date(last_start);

  last_end.setDate(last_start.getDate() - 1);
  last_start.setDate(last_end.getDate() - term);

  last_start = dateFormat(last_start, "yyyy-mm-dd");
  last_end = dateFormat(last_end, "yyyy-mm-dd");

  // 입력한 시작일과 종료일이 같으면 날짜는 한개만 출력
  if(start_date == end_date) {
    $('#this').html(start_date);
    $('#last').html(last_start);
  } else {  // 아니면 시작일, 종료일 출력
    $('#this').html(start_date + " ~ " + end_date);
    $('#last').html(last_start + " ~ " + last_end);
  }

  // 표 다시 출력
  platformData();
}

// 표 출력하는 부분
function platformData() {
  var startdate = '';
  var enddate = '';

  var thisWeekTotal = '';
  var thisWeekPaid = '';
  var thisWeekFree = '';

  var lastWeekTotal = '';
  var lastWeekPaid = '';
  var lastWeekFree = '';

  var variTotal = '';
  var variPaid = '';
  var variFree = '';

  setTimeout(function() {
    startdate = $('#start_date_table').val();
    enddate = $('#end_date_table').val();

  $.ajax({
      url: "/sales",
      method: "post",
      data: {
        start: startdate,
        end: enddate
      },
      success: function(data) {
		arr = ['Pf', 'Pa', 'Mi', 'Rt', 'Ma'];
		console.log(data);
        $.each(arr, function(index, item) {
			thisWeekTotal = data[item][0]['thisTotal'];
			thisWeekPaid = data[item][0]['thisPaid'];
			thisWeekFree = data[item][0]['thisFree'];

			lastWeekTotal = data[item][1]['lastTotal'];
			lastWeekPaid = data[item][1]['lastPaid'];
			lastWeekFree = data[item][1]['lastFree'];

			variTotal = variation(thisWeekTotal, lastWeekTotal);
			variPaid = variation(thisWeekPaid, lastWeekPaid);
			variFree = variation(thisWeekFree, lastWeekFree);

			$('#thisWeekTotal'+item).html(thisWeekTotal);
			$('#thisWeekPaid'+item).html(thisWeekPaid);
			$('#thisWeekFree'+item).html(thisWeekFree);

			$('#lastWeekTotal'+item).html(lastWeekTotal);
			$('#lastWeekPaid'+item).html(lastWeekPaid);
			$('#lastWeekFree'+item).html(lastWeekFree);

			$('#variTotal'+item).html(variTotal);
			$('#variPaid'+item).html(variPaid);
			$('#variFree'+item).html(variFree);
		});
      },
      error: function(err) {
        console.log(err);
      }
    });

  }, 10);
}

// 증감수 계산
function variation(val1, val2) {
  return val1 - val2;
}

// dateformat 부분
var dateFormat = function () {
    var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
        timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
        timezoneClip = /[^-+\dA-Z]/g,
        pad = function (val, len) {
            val = String(val);
            len = len || 2;
            while (val.length < len) val = "0" + val;
            return val;
        };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var _ = utc ? "getUTC" : "get",
            d = date[_ + "Date"](),
            D = date[_ + "Day"](),
            m = date[_ + "Month"](),
            y = date[_ + "FullYear"](),
            H = date[_ + "Hours"](),
            M = date[_ + "Minutes"](),
            s = date[_ + "Seconds"](),
            L = date[_ + "Milliseconds"](),
            o = utc ? 0 : date.getTimezoneOffset(),
            flags = {
                d:    d,
                dd:   pad(d),
                ddd:  dF.i18n.dayNames[D],
                dddd: dF.i18n.dayNames[D + 7],
                m:    m + 1,
                mm:   pad(m + 1),
                mmm:  dF.i18n.monthNames[m],
                mmmm: dF.i18n.monthNames[m + 12],
                yy:   String(y).slice(2),
                yyyy: y,
                h:    H % 12 || 12,
                hh:   pad(H % 12 || 12),
                H:    H,
                HH:   pad(H),
                M:    M,
                MM:   pad(M),
                s:    s,
                ss:   pad(s),
                l:    pad(L, 3),
                L:    pad(L > 99 ? Math.round(L / 10) : L),
                t:    H < 12 ? "a"  : "p",
                tt:   H < 12 ? "am" : "pm",
                T:    H < 12 ? "A"  : "P",
                TT:   H < 12 ? "AM" : "PM",
                Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default":      "ddd mmm dd yyyy HH:MM:ss",
    shortDate:      "m/d/yy",
    mediumDate:     "mmm d, yyyy",
    longDate:       "mmmm d, yyyy",
    fullDate:       "dddd, mmmm d, yyyy",
    shortTime:      "h:MM TT",
    mediumTime:     "h:MM:ss TT",
    longTime:       "h:MM:ss TT Z",
    isoDate:        "yyyy-mm-dd",
    isoTime:        "HH:MM:ss",
    isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
    dayNames: [
        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ],
    monthNames: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};
</script>

@endsection