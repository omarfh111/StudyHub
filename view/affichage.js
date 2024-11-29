document.addEventListener('DOMContentLoaded', function () {
  // Loop through each product card
  const productCards = document.querySelectorAll('.product-card');
  
  productCards.forEach(card => {
      // Get the quantity from the data attribute
      const quantity = parseInt(card.getAttribute('data-quantity'));
      
      // Get the Buy Now and Add to Cart buttons for this product
      const buyNowButton = card.querySelector('.buy-now');
      const addToCartButton = card.querySelector('.add-to-cart');
      
      // If quantity is 0 (out of stock), disable the buttons
      if (quantity <= 0) {
          buyNowButton.disabled = true;
          addToCartButton.disabled = true;
      } else {
          buyNowButton.disabled = false;
          addToCartButton.disabled = false;
      }
  });
});
