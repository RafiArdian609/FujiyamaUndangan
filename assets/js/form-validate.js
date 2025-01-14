function valid_datas(f) {
	// Check if name is empty
	if (f.name.value == '') {
	  jQuery('#form_status').html('<span class="wrong">Nama Anda tidak boleh kosong!</span>');
	  notice(f.name);
	// Check if email is empty or has incorrect format
	} else if (f.email.value == '' || !isValidEmail(f.email.value)) {
	  jQuery('#form_status').html('<span class="wrong">Email Anda harus diisi dan dalam format yang benar!</span>');
	  notice(f.email);
	// Check if reservation date is empty  
	} else if (f.reservation_date.value == '') {
	  jQuery('#form_status').html('<span class="wrong">Tanggal reservasi harus diisi!</span>');
	  notice(f.reservation_date);
	// Check if reservation time is empty  
	} else if (f.reservation_time.value == '') {
	  jQuery('#form_status').html('<span class="wrong">Waktu reservasi harus diisi!</span>');
	  notice(f.reservation_time);
	// Check if guest count is empty  
	} else if (f.guest_count.value == '') {
	  jQuery('#form_status').html('<span class="wrong">Jumlah tamu harus diisi!</span>');
	  notice(f.guest_count);
	} else {
	  // Submit the form if all fields are valid
	  jQuery.ajax({
		url: 'mail.php',
		type: 'post',
		data: jQuery('form#fruitkha-contact').serialize(),
		complete: function(data) {
		  jQuery('#form_status').html(data.responseText);
		  jQuery('#fruitkha-contact').find('input,textarea').attr({ value: '' });
		  jQuery('#fruitkha-contact').css({ opacity: 1 });
		  jQuery('#fruitkha-contact').remove();
		}
	  });
	  jQuery('#form_status').html('<span class="loading">Mengirim pesan Anda...</span>');
	  jQuery('#fruitkha-contact').animate({ opacity: 0.3 });
	  jQuery('#fruitkha-contact').find('input,textarea,button').css('border', 'none').attr({ 'disabled': '' });
	}
  
	return false;
  }
  
  function notice(f) {
	jQuery('#fruitkha-contact').find('input,textarea').css('border', 'none');
	f.style.border = '1px solid red';
	f.focus();
  }
  
  // Function to validate email format
  function isValidEmail(email) {
	const re = /^(([^<>().,;: \t\n\v\f\u200b\u200e\u200f])+(\.[^<>().,;: \t\n\v\f\u200b\u200e\u200f]*)*)@(([^<>().,;: \t\n\v\f\u200b\u200e\u200f]+\.)+[a-zA-Z]{2,})$/;
	return re.test(String(email).toLowerCase());
  }