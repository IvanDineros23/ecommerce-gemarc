// Product card click handler
document.addEventListener('DOMContentLoaded', function() {
  const productCards = document.querySelectorAll('[data-product-card]');
  
  productCards.forEach(card => {
    card.addEventListener('click', function() {
      const categoryPage = this.getAttribute('data-category-page');
      if (categoryPage) {
        window.location.href = categoryPage;
      }
    });
  });
});