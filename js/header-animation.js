window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
      document.querySelector('header').classList.add('scrolled');
    } else {
      document.querySelector('header').classList.remove('scrolled');
    }
  });