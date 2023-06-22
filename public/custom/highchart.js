$(document).ready(function() {
    var table = $("#example").DataTable();
 
    var myChart = Highcharts.chart("container", {
        chart: {
            type: "pie"
        },
        title: {
            text: "Staff Count Per Office"
        },
        series: [{
            data: chartData(table)
        }]
    });
 
    // Set the data for the first series to be the map returned from the chartData function
    table.on("draw", function() {
        myChart.series[0].setData(chartData(table));
    });
});
 
function chartData(table) {
    var counts = {};
 
    // Count the number of entries for each office
    table
        .column(2, { search: 'applied' })
        .data()
        .each(function (val) {
            if (counts[val]) {
                counts[val] += 1;
            } else {
                counts[val] = 1;
            }
        });
 
    // And map it to the format highcharts uses
    return $.map(counts, function (val, key) {
        return {
            name: key,
            y: val,
        };
    });
}