function addProduct() {
   var i=0;
    if(document.getElementById("name").value.length === 0) {
        alert("Champ invalid du produit");
        i=1;
    }
   if(document.getElementById("price").value < 0) {
       alert("Champ invalid du prix");
       i=1;
   }
    if(document.getElementById("quantite").value<0) {
        alert("Champ invalid de la quantité");
        i=1;
    }
    if (document.getElementById("reduction").value < 0 || document.getElementById("reduction").value > 100) {
        alert("Champ invalid de la reduction");
        i=1;
    }
    if (i === 0) {
        // If all fields are valid, submit the form
        document.getElementById("myForm").submit();
      }
    
}