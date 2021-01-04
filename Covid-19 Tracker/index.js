let jsonData, size;
fetch("https://pomber.github.io/covid19/timeseries.json")
  .then((response) => response.json())
  .then((data) => {jsonData=data; size = jsonData['Afghanistan'].length;})


function options(chartid,color,title){
    let obj = {
      chart: {
        group: 'covid-analysis',
        id: chartid,
        type: 'area',
        height: 350,
        animations: {
          enabled: true,
        },
        zoom: {
          autoScaleYaxis: true,
        }
      },
      series: [{
        name: 'Cases',
        data: [30,40,35,50,49,60,70,91,125]
      }],
      colors: [color],
      title: {
        text: title,
        align: 'left'
      },
      yaxis:{
        min: 0,
        suggestedMax: 10000000,
        labels:{
          minWidth: 0
        }
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.7,
          opacityTo: 0.9,
          stops: [0, 100]
        }
      }, 
      tooltip: {
        x: {
          format: 'dd MMM yyyy'
        }
      },
      dataLabels: {enabled: false},
      xaxis: {
        type: 'datetime',
          min: new Date('21 Jan 2020').getTime(),
          tickAmount: 6,
      }
    };

    return obj;

}

let chart1 = new ApexCharts(document.querySelector("#chart1"), options(1,'#ff4646', 'Confirmed'));
let chart2 = new ApexCharts(document.querySelector("#chart2"), options(2,'#008FFB', 'Active'));
let chart3 = new ApexCharts(document.querySelector("#chart3"), options(3,'#16c79a', 'Recovered'));
let chart4 = new ApexCharts(document.querySelector("#chart4"), options(4,'#495464', 'Deceased'));
chart1.render();
chart2.render();
chart3.render();
chart4.render();

function showGraph(country) {
   
  console.log('here')

//   console.log(dataset['Afghanistan'][338]['confirmed']);
let confirmed=[];
let active=[];
let deceased=[];
let recovered=[];
let tempconfirmed=[];
let tempactive=[];
let tempdeceased=[];
let temprecovered=[];
day=0;

while(day<size){
  tempconfirmed.push(new Date(jsonData[country][day]['date']).getTime());
  tempactive.push(new Date(jsonData[country][day]['date']).getTime());
  temprecovered.push(new Date(jsonData[country][day]['date']).getTime());
  tempdeceased.push(new Date(jsonData[country][day]['date']).getTime());
  confirmedcases = jsonData[country][day]['confirmed'];
  recoveredcases = jsonData[country][day]['recovered'];
  deceasedcases = jsonData[country][day++]['deaths'];
  tempconfirmed.push(confirmedcases);
  tempactive.push(confirmedcases - recoveredcases - deceasedcases);
  temprecovered.push(recoveredcases);
  tempdeceased.push(deceasedcases);
}

while(tempconfirmed.length) confirmed.push(tempconfirmed.splice(0,2));
while(tempactive.length) active.push(tempactive.splice(0,2));
while(temprecovered.length) recovered.push(temprecovered.splice(0,2));
while(tempdeceased.length) deceased.push(tempdeceased.splice(0,2));

chart1.updateSeries([{
  name: 'Confirmed',
  data: confirmed
}]);
chart1.zoomX(
  new Date('23 Jan 2020').getTime(),
  new Date('21 Jan 2021').getTime()
);

chart2.updateSeries([{
  name: 'Active',
  data: active
}]);
chart2.zoomX(
  new Date('23 Jan 2020').getTime(),
  new Date('21 Jan 2021').getTime()
);

chart3.updateSeries([{
  name: 'Recovered',
  data: recovered
}]);
chart3.zoomX(
  new Date('23 Jan 2020').getTime(),
  new Date('21 Jan 2021').getTime()
);

chart4.updateSeries([{
  name: 'Deceased',
  data: deceased
}]);
chart4.zoomX(
  new Date('23 Jan 2020').getTime(),
  new Date('21 Jan 2021').getTime()
);
}

// Scroll to top
let btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});