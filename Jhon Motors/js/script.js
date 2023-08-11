const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function showSlide(slideIndex) {
      slides.forEach((slide, index) => {
        if (index === slideIndex) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    showSlide(currentSlide);

    // Auto cambiar slide cada 5 segundos
    setInterval(nextSlide, 5000);

    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    prevBtn.addEventListener('click', () => {
      prevSlide();
    });

    nextBtn.addEventListener('click', () => {
      nextSlide();
    });