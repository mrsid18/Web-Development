console.log('this is index js');



let source = 'bbc-news';
let apiKey = '5de6df6d2bc94779b0fae82cb5489153';
let apitoken = 'b17c57cc7f0d62ae815f63dbb2366c9f';
const xhr = new XMLHttpRequest();
// xhr.open('GET', `https://newsapi.org/v2/top-headlines?sources=${source}&apiKey=${apiKey}`, true);
// xhr.open('GET',`http://newsapi.org/v2/top-headlines?country=in&apiKey=5de6df6d2bc94779b0fae82cb5489153`, true);
// xhr.open('GET',`https://gnews.io/api/v4/top-headlines?token=${apitoken}`, true);
// https://gnews.io/api/v4/top-headlines?&token=${apitoken}
fetch(`http://newsapi.org/v2/top-headlines?country=in&apiKey=5de6df6d2bc94779b0fae82cb5489153`)
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    let newsAccordion = document.getElementById('accordionExample');
    let html = '';
    console.log(data);
    // if (this.status == 200){
    let json = data;
    let articles = json.articles;
    console.log(articles);
    articles.forEach(function (element, index) {
      html += `<div class="card-header" id="heading${index + 1}">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse${index + 1}" aria-expanded="true" aria-controls="collapse${index + 1}">
                 ${element.title}
                </button>
              </h2>
            </div>
        
            <div id="collapse${index + 1}" class="collapse" aria-labelledby="heading${index + 1}" data-parent="#accordionExample">
              <div class="card-body">
               ${element.content}<a href="${element.url}"> Read more</a>
              </div>
            </div>`

    });

    newsAccordion.innerHTML = html;
  });

// xhr.onload = function(){
//     let newsAccordion = document.getElementById('accordionExample');
//     let html = '';
//     if (this.status == 200){
//         let json = JSON.parse(this.responseText);
//         let articles = json.articles;
//         console.log(articles);
//         articles.forEach(function(element, index){
//             html += `<div class="card-header" id="heading${index+1}">
//             <h2 class="mb-0">
//               <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse${index+1}" aria-expanded="true" aria-controls="collapse${index+1}">
//                ${element.title}
//               </button>
//             </h2>
//           </div>

//           <div id="collapse${index+1}" class="collapse" aria-labelledby="heading${index+1}" data-parent="#accordionExample">
//             <div class="card-body">
//              ${element.content}<a href="${element.url}"> Read more</a>
//             </div>
//           </div>`

//         });

//         newsAccordion.innerHTML = html;

//     }
// }

// xhr.send()

