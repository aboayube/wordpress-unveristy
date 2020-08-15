${results.event.length ?'':'<p>No events match that search </p>'}
${results.event.map(item=>`

<div class="event-summary">
<a class="event-summary__date t-center" href="${item.permalink}">

</a>
<div class="event-summary__content">
<p>${item.discription}<a href="${item.permalink}" class="nu gray">learn more</a>

</div>
</div>
	

	`).join('')}
