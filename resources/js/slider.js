document.addEventListener('DOMContentLoaded', function () {
  const slider = document.querySelector('.latest-products');
  const products = slider ? slider.children : [];
  const prevBtn = document.querySelector('#slider-prev');
  const nextBtn = document.querySelector('#slider-next');
  let currentIndex = 0;
  const itemsPerSlide = 4;

  if (products.length > 4 && slider && prevBtn && nextBtn) {
    function updateSlider() {
      const productWidth = products[0].offsetWidth + 15; // including gap
      slider.style.transform = `translateX(-${currentIndex * productWidth * itemsPerSlide}px)`;
    }

    prevBtn.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
      }
    });

    nextBtn.addEventListener('click', () => {
      if (currentIndex < Math.ceil(products.length / itemsPerSlide) - 1) {
        currentIndex++;
        updateSlider();
      }
    });
  }
});
