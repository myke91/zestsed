$(document).ready(function () {
    "use strict";
    //ct-visits
    new Chartist.Line('#ct-visits', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        series: [
            [2, 5, 2, 6, 2, 5, 2, 4, 4, 2, 6, 5],
            [5, 8, 2, 1, 9, 5, 2, 5, 1, 7, 3, 9]
        ]
    }, {
        top: 0,
        low: 1,
        showPoint: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ],
        axisY: {
            labelInterpolationFnc: function (value) {
                return (value / 1);
            }
        },
        showArea: true
    });
    // counter
    $(".counter").counterUp({
        delay: 100,
        time: 1200
    });

    // var sparklineLogin = function () {
    //     $('#sparklinedash').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
    //         type: 'bar',
    //         height: '30',
    //         barWidth: '4',
    //         resize: true,
    //         barSpacing: '5',
    //         barColor: '#7ace4c'
    //     });
    //     $('#sparklinedash2').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
    //         type: 'bar',
    //         height: '30',
    //         barWidth: '4',
    //         resize: true,
    //         barSpacing: '5',
    //         barColor: '#7460ee'
    //     });
    //     $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
    //         type: 'bar',
    //         height: '30',
    //         barWidth: '4',
    //         resize: true,
    //         barSpacing: '5',
    //         barColor: '#11a0f8'
    //     });
    //     $('#sparklinedash4').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
    //         type: 'bar',
    //         height: '30',
    //         barWidth: '4',
    //         resize: true,
    //         barSpacing: '5',
    //         barColor: '#f33155'
    //     });
    // }
    // var sparkResize;
    // $(window).on("resize", function (e) {
    //     clearTimeout(sparkResize);
    //     sparkResize = setTimeout(sparklineLogin, 500);
    // });
    // sparklineLogin();
});