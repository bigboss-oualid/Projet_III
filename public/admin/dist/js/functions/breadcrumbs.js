function myBreadcrumbs() {
	//steps to set the active sidebar link
	//Get the current link
	var currentUrl = window.location.href;
	console.log(currentUrl);
	//Get the last segment of the url
	var segment = currentUrl.split('/').pop();
	console.log(segment);
	//Add the "active" class to the id in sidebar of the current url
	$('#' + segment + '-link').addClass('active');
 
}
