function required() {
  let firstName = document.getElementById("firstName").value;
  let lastName  = document.getElementById("lastName").value;
  let birthDate = document.getElementById("birthDate").value;

  if (firstName === "") {
    alert("Insérer votre Prénom svp !");
    
    return false;

  } else if (lastName === "") {
      alert("Insérer votre Nom svp !");
      
      return false;
  
  } else if (birthDate === "") {
      alert("Insérer votre Date de Naissance svp !");
      
      return false;
  
  } else {
    
    return true; 
  }
}

if (document.getElementById("paypal-button")) {
  paypal.Buttons({
    style: {
      color:  "blue",
      shape:  "pill",
      label:  "pay"
    },
  
    onInit: function(data, actions) {
  
      actions.disable();
  
      document.getElementById("birthDate")
      .addEventListener("change", function(event) {
  
        if (event.target.value !== "") {
          actions.enable();
  
        } else {
          actions.disable();
        }
      });
    },
  
    onClick: function() {
  
      if (!required()) {
        alert("Transaction annulée !");
      }
    },
  
    createOrder : function (data, actions) {
  
      return actions.order.create({
  
        purchase_units : [{
          amount : {
            value : "10.00",
            currency_code : "EUR"
          }
        }]
      });
    },
  
    onApprove : function (data, actions) {
  
      return actions.order.capture().then(
  
        function(details) {
               
          alert("Transaction validée par " + 
          details.payer.name.given_name + 
          " " + 
          details.payer.name.surname);
  
          if (required()) {
            document.getElementById("form").submit();
          }
        }
      );
    },
  
    onCancel : function (data) {
      alert("Transaction annulée !");
    },
  
    onError: function(err) {
      alert("Transaction invalide !");
  
      throw new Error(err);
    }
  })
  .render("#paypal-button");  
}
