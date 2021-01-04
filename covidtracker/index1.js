let jsonData;
fetch("https://pomber.github.io/covid19/timeseries.json")
  .then((response) => response.json())
  .then((data) => jsonData=data)
// let afg=[];
// let dates=[];
// day=0;
// while(day<339){
//   dates.push(day);
//     afg.push(jsonData['Afghanistan'][day++]['confirmed']);
    
// }
//   let ctx = document.getElementById("myChart").getContext("2d");
//   let myChart = new Chart(ctx, {
//     type: "line",
//     data: {
//       datasets: [
//         {
//           label: "First dataset",
//           data: afg,
//         },
//       ],
//       labels:dates ,
//     },
//     options: {
//         responsive:true,
//       scales: {
//         yAxes: [
//           {
//             ticks: {
//             //   suggestedMin: 50000,
//             //   suggestedMax: 100000,
//             },
//           },
//         ],
//       },
//     },
//   })


function showGraph(country) {
   
    console.log('here')

//   console.log(dataset['Afghanistan'][338]['confirmed']);
let afg=[];
let dates=[];
day=0;
while(day<339){
  dates.push(day);
    afg.push(jsonData[country][day++]['confirmed']);
    
}
  let ctx = document.getElementById("myChart").getContext("2d");
  let myChart = new Chart(ctx, {
    type: "line",
    data: {
      datasets: [
        {
          label: "First dataset",
          data: afg,
        },
      ],
      labels:dates ,
    },
    options: {
        responsive:true,
      scales: {
        yAxes: [
          {
            ticks: {
            //   suggestedMin: 50000,
            //   suggestedMax: 100000,
            },
          },
        ],
      },
    },
  })


}


