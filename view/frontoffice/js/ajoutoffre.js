function valid() {
    if (document.getElementById("product-name").value.length === 0) {
      alert("Champ invalid du produit");
    }
    if (document.getElementById("product-price").value < 0 ) {
      alert("Champ invalid du prix");
    }
    if(document.getElementById("quantity").value<0){
      alert("Champ invalid de la quantité");
    }
    
    if (document.getElementById("reduction").value < 0)  {
      alert("Champ invalid de la reduction");
    }
   
  }