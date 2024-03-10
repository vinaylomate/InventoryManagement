var pieChartValues = [{ y: 39.16,exploded: true,indexLabel: "SM",color: "#00badd"}, 

{
  y: 21.8,
  indexLabel: "Bing",
  color: "#e60023"
}, {
  y: 21.45,
  indexLabel: "Yahoo",
  color: "#4267b2"
}, {
  y: 5.56,
  indexLabel: "Baidu",
  color: "#ef4d5d"
}, {
  y: 5.38,
  indexLabel: "Yandex",
  color: "#5cb85c"
}, {
  y: 3.73,
  indexLabel: "DuckDuckGo",
  color: "#fd9d08"
}, {
  y: 2.92,
  indexLabel: "ASk.com",
  color: "#9dcb07"}];
renderPieChart(pieChartValues);

function renderPieChart(values) {

  var chart = new CanvasJS.Chart("pieChart", {
    backgroundColor: "white",
    colorSet: "colorSet2",

    title: {
      //text: "Pie Chart",
	  text: "line chart",
      fontFamily: "Verdana",
      fontSize: 25,
      fontWeight: "normal",
    },
    animationEnabled: true,
    data: [{
      indexLabelFontSize: 15,
      indexLabelFontFamily: "Monospace",
      indexLabelFontColor: "darkgrey",
      indexLabelLineColor: "darkgrey",
      indexLabelPlacement: "outside",
      type: "line",
      showInLegend: false,
      toolTipContent: "#percent%",
      dataPoints: values
    }]
  });
  chart.render();
}
var columnChartValues = [{y: 686.04,label: "SM",color: "#00badd"
}, {
  y: 381.84,
  label: "Bing",
  color: "#e60023"
}, {
  y: 375.76,
  label: "Yahoo",
  color: " #4267b2"
}, {
  y: 97.48,
  label: "Baidu",
  color: "#ef4d5d"
}, {
  y: 94.2,
  label: "Yandex",
  color: "#5cb85c"
}, {
  y: 65.28,
  label: "DuckDuckGO",
  color: "#fd9d08"
}, {
  y: 51.2,
  label: "Ask.com",
  color: "#9dcb07"
}];
renderColumnChart(columnChartValues);

function renderColumnChart(values) {

  var chart = new CanvasJS.Chart("columnChart", {
    backgroundColor: "white",
    colorSet: "colorSet3",
    title: {
      text: "Column Chart",
      fontFamily: "Verdana",
      fontSize: 25,
      fontWeight: "normal",
    },
    animationEnabled: true,
    legend: {
      verticalAlign: "bottom",
      horizontalAlign: "center"
    },
    theme: "theme2",
    data: [

      {
        indexLabelFontSize: 15,
        indexLabelFontFamily: "Monospace",
        indexLabelFontColor: "darkgrey",
        indexLabelLineColor: "darkgrey",
        indexLabelPlacement: "outside",
        type: "line",
        showInLegend: false,
        legendMarkerColor: "grey",
        dataPoints: values
      }
    ]
  });

  chart.render();
}
  