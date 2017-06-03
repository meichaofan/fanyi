/**
 * 
 */
 $(function(){
	 //先选出textarea和统计的dom字数
	 var wordCount = $("#wordCount");
	 textArea = wordCount.find("textarea");
	 word=wordCount.find(".word");
	 //调用
	 statInputNum(textArea,word);
 });
 
 function statInputNum(textArea,numItem){
	 var max = numItem.text(),  
     curLength;  
	 textArea[0].setAttribute("maxlength", max);  
	 curLength = textArea.val().length;  
	 numItem.text(max - curLength);  
	 textArea.on('input propertychange', function () {  
     numItem.text(max - $(this).val().length);  
 });  
}  