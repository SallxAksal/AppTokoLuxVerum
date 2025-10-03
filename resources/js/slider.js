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

  // Slider banner iklan di katalog dengan pergantian otomatis setiap 3 detik
  const bannerSliderContainer = document.querySelector('.banner-slider-container');
  if (bannerSliderContainer) {
    const bannerSlider = bannerSliderContainer.querySelector('.banner-slider');
    const banners = bannerSlider ? bannerSlider.children : [];
    let currentIndex = 0;

    function showBanner(index) {
      const bannerWidth = bannerSliderContainer.offsetWidth;
      bannerSlider.style.transform = `translateX(-${index * bannerWidth}px)`;
    }

    if (banners.length > 1) {
      setInterval(() => {
        currentIndex = (currentIndex + 1) % banners.length;
        showBanner(currentIndex);
      }, 3000);
    }
  }
});
