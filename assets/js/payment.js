Stripe.setPublishableKey('pk_test_51MrfqWSG5EZig5KqF7V6n5s4GS3ogtWUPx7mDpHV00QiOfcOW6TnfAywc6j0Vfws2EpFXzj9GCY7JwnRjpZRS3L500CTOCEAcq');

function stripePay(event) {
    event.preventDefault(); 
    if(validateForm() == true) {
     $('#payNow').attr('disabled', 'disabled');
     $('#payNow').val('Payment Processing....');
     Stripe.createToken({
      number:$('#cardNumber').val(),
      cvc:$('#cardCVC').val(),
      exp_month : $('#cardExpMonth').val(),
      exp_year : $('#cardExpYear').val()
     }, stripeResponseHandler);
     return false;
    }
}

function stripeResponseHandler(status, response) {
 if(response.error) {
  $('#payNow').attr('disabled', false);
  $('#message').html(response.error.message).show();
 } else {
  var stripeToken = response['id'];
  $('#paymentForm').append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");

  $('#paymentForm').submit();
 }
}

function validateForm() {
 var email = $('#email').val();
 var name = $('#name').val();
 var address = $('#address').val();
var phone =$('#phone').val();
var pincode = $('#pincode').val();

  if(!validateName.test(name)) {
   $('#name').addClass('require');
   $('#errorname').text('Invalid Name');
   valid = false;
  } else {
   $('#name').removeClass('require');
   $('#errorname').text('');
   valid = true;
  }

  if(!validateEmail.test(email)) {
   $('#email').addClass('require');
   $('#erroremail').text('Invalid Email Address');
   valid = false;
  } else {
   $('#email').removeClass('require');
   $('#erroremail').text('');
   valid = true;
  }

  if(address == '') {
   $('#address').addClass('require');
   $('#erroraddress').text('Enter Address Detail');
   valid = false;
  } else {
   $('#address').removeClass('require');
   $('#erroraddress').text('');
   valid = true;
  }

  if(phone == ''){
   $('#phone').addClass('require');
   $('#errorphone').text('Enter City');
   valid = false;
  } else {
   $('#phone').removeClass('require');
   $('#errorphone').text('');
   valid = true;
  }

  if(pincode == ''){
   $('#pincode').addClass('require');
   $('#errorpincode').text('Enter Zip code');
   valid = false;
  } else {
   $('#pincode').removeClass('require');
   $('#errorpincode').text('');
   valid = true;
  }

 
 }
 return valid;


function validateNumber(event) {
 var charCode = (event.which) ? event.which : event.keyCode;
 if (charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57)){
  return false;
 }
 return true;
}