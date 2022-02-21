function calDateUTC() {
    let date = new Date();
    let y = date.getUTCFullYear();
    let m = date.getUTCMonth();
    let d = date.getUTCDate();
    let h = date.getUTCHours();
    let M = date.getUTCMinutes();
    let s = date.getUTCSeconds();
    let date_90 = new Date(y, m, d, h, M, s);
    let day = date_90.getDate();
    let month = date_90.getMonth() + 1;
    let year = date_90.getFullYear();
    if (month < 10) { month = "0" + month };
    if (day < 10) { day = "0" + day };
    let today = year + "-" + month + "-" + day;

    let AddDayCount = -90;
    let dd = new Date(y, m, d, h, M, s);
    dd.setDate(dd.getDate() + AddDayCount);
    let yy = dd.getFullYear();
    let mm = (dd.getMonth() + 1) < 10 ? "0" + (dd.getMonth() + 1) : (dd.getMonth() + 1);
    let dday = dd.getDate() < 10 ? "0" + dd.getDate() : dd.getDate();
    let day_90 = yy + "-" + mm + "-" + dday;
    dd = {};
    dd['today'] = today;
    dd['day_90'] = day_90;
    return dd;
}

$(document).ready(function () {

    let dd = calDateUTC();
    $("#dateto").attr("value", dd.today);
    $("#datefrom").attr("value", dd.day_90);
    get_events();

}
);