var openButton=$('.js-search-trigger');
var closeButton=$('.search-overlay__close');
var searchOverlay=$('.search-overlay');
var	isOverlayOpen=false;
var searchFeild=$('#search-term');
var typingTimer;
var results=$('#search-overlay__results');
var isSpinnerVisable=false;
var previousValue;

$(document).on("keyup",function(event){
if(event.keyCode==83  && !isOverlayOpen && !$("input,textarea").is(':focus')){
searchOverlay.addClass('search-overlay--active');
$('body').addClass('body-no-scroll');
searchFeild.val('');
setTimeout(()=>searchFeild.focus(),301);
isOverlayOpen=true;
}
if(event.keyCode==27 && isOverlayOpen){
searchOverlay.removeClass('search-overlay--active');
$('body').removeClass('body-no-scroll');
isOverlayOpen=false;
}
});

searchFeild.on('keyup',function(){
	if(searchFeild.val()!= previousValue){

clearTimeout(typingTimer);

if(searchFeild.val()){


if(!isSpinnerVisable){
results.html('<div class="spinner-loader"></div>');
isSpinnerVisable=true;
}
typingTimer= setTimeout(function(){
$.getJSON(
secondWajeeh.root_url+'/wp-json/wajeeh/v1/search?term='+searchFeild.val()
	,(result)=>{
	results.html(`
<div class="row">
    <div class="one-third">
<h2 class="search-overlay__section-title">Gengrenal Information</h2>
${result.generalInfo.length? '<ul class="link-list min-list">':'<p>no result</p>'}
${result.generalInfo.map(item=> `
<li><a href="${item.permalink}">${item.title}</a>  ${item.postType=='post'?`by ${item.authorName}`:''}</li>`).join('')}
${result.generalInfo.length? '</ul>':''}
    </div>
    <div class="one-third">
<h2 class="search-overlay__section-title">programms</h2>
${result.programs.length? '<ul class="link-list min-list">':`<p>no programs is matches.<a href="${secondWajeeh.root_url}/programs">programs</a></p>`}
${result.programs.map(item=> `
<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
${result.programs.length? 	'</ul>':''}
<h2 class="search-overlay__section-title">professors</h2>
${result.professors.length? '<ul class="professor-cards">':'<p>no result</p>'}
${result.professors.map(item=> `
<li class="professor-card__list-item">
<a class="professor-card" href="${item.permalink}">
<img src="${item.image}" class="professor-card__image">
<span class="professor-card__name">${item.title}</span>	
</a>
</li>
	`).join('')}

    </div>
    <div class="one-third">
<h2 class="search-overlay__section-title">cammpus</h2>
${result.campuses.length? '<ul class="link-list min-list">':'<p>no result</p>'}
${result.campuses.map(item=> `
<li><a href="${item.permalink}">${item.title}</a>`).join('')}
${result.campuses.length? '</ul>':''}

</div>
<div class="one-third">
<h2 class="search-overlay__section-title">Event</h2>
${result.events.length? '':'<p>no events</p>'}
${result.events.map(item=> `

<div class="event-summary">
<a class="event-summary__date t-center" href="${item.permalink}">
<span class="event-summary__month"${item.month}</span>
<span class="event-summary__day">${item.day}</span>
</a>
<div class="event-summary__content">
<p>${item.discription}<a href="${item.permalink}" class="nu gray">learn more</a>

</div>
</div>
	


	`).join('')}
</div>
</div>`);
	isSpinnerVisable=false;
})


},200);
}
else{
	results.html('');
	isSpinnerVisable=false;
}
}
previousValue=searchFeild.val();
});




// on click
openButton.on('click',function(){
searchOverlay.addClass('search-overlay--active');
$('body').addClass('body-no-scroll');
setTimeout(()=>searchFeild.focus(),301);	
isOverlayOpen=true;
return false;
});

closeButton.on('click',function(){
searchOverlay.removeClass('search-overlay--active');
});

