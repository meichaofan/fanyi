/**
 * 
 */
$('#file-fr').fileinput({
	uploadUrl : "upload.php",
	uploadAsync : false,
	language : 'zh',
	minFileCount : 1,
	maxFileCount : 1,
	allowedFileExtensions: ['pdf'],
	initialPreviewAsData : true
});
