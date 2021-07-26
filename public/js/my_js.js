function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				element.attr("name",$(this).attr("name"));
				element.change(function(){
					element.next(element).find('input').val((element.val()).split('\\').pop());
				});
				$(this).find("button.btn-choose").click(function(){
					element.click();
				});
				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});
				$(this).find('input').css("cursor","pointer");
				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});
				return element;
			}
		}
	);
}
$(function() {
	bs_input_file();
});

/* sweet  alert messages*/
 $('.show_confirm').click(function(event) {
	  var form =  $(this).closest("form");
	  var name = $(this).data("name");
	  event.preventDefault();
	  swal({
		  title: `Are you sure you want to delete this record?`,
		  text: "If you delete this, it will be gone forever.",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
	  })
	  .then((willDelete) => {
		if (willDelete) {
		  form.submit();
		}
	  });
  });

$(document).ready(function(){
	let result = document.querySelector('.result'),
	img_result = document.querySelector('.img-result'),
	img_w = document.querySelector('.img-w'),
	img_h = document.querySelector('.img-h'),
	options = document.querySelector('.options'),
	save = document.querySelector('.save'),
	cropped = document.querySelector('.cropped'),
	dwn = document.querySelector('.download'),
	upload = document.querySelector('#file-input'),
	cropper = '';
	
	// on change show image with crop options
	upload.addEventListener('change', (e) => {
	  if (e.target.files.length) {
			// start file reader
		const reader = new FileReader();
		reader.onload = (e)=> {
		  if(e.target.result){
					// create new image
					let img = document.createElement('img');
					img.id = 'image';
					img.src = e.target.result
					// clean result before
					result.innerHTML = '';
					// append new image
			result.appendChild(img);
					// show save btn and options
					save.classList.remove('hide');
					options.classList.remove('hide');
					// init cropper
					cropper = new Cropper(img);
		  }
		};
		reader.readAsDataURL(e.target.files[0]);
	  }
	});
	
	// save on click
	save.addEventListener('click',(e)=>{
	  e.preventDefault();
	  // get result to data uri
	  let imgSrc = cropper.getCroppedCanvas({
			width: img_w.value // input value
		}).toDataURL();
	  // remove hide class of img
	  cropped.classList.remove('hide');
		img_result.classList.remove('hide');
		// show image cropped
	  cropped.src = imgSrc;
	  dwn.classList.remove('hide');
	  dwn.download = 'imagename.png';
	  dwn.setAttribute('href',imgSrc);
	});
	
	
})