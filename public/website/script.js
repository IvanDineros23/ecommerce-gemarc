// ===================================================================
// GEMARC ENTERPRISES - MAIN JAVASCRIPT FILE
// All JavaScript functionality consolidated here (no inline JS!)
// ===================================================================

// ===================================================================
// MOBILE MENU FUNCTIONS
// ===================================================================
function toggleMobileMenu(){
  const mobileMenu = document.getElementById("mobileMenu");
  if(!mobileMenu) return;
  mobileMenu.classList.add("active");
  document.body.style.overflow = "hidden";
}

// Initialize mobile menu when DOM loads
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');
    const mainButtons = document.querySelectorAll('.mobile-menu-main');

    // Open mobile menu
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    // Close mobile menu
    if (closeMenu && mobileMenu) {
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Accordion dropdown logic
    // Accordion dropdown logic (parents only expand/collapse)
mainButtons.forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Close other submenus
    mainButtons.forEach(otherBtn => {
      if (otherBtn !== btn) {
        otherBtn.classList.remove('active');
      }
    });

    // Toggle current submenu
    btn.classList.toggle('active');
  });
});

// Submenu links should close the menu on navigation
document.querySelectorAll('.mobile-menu-sub a').forEach(link => {
  link.addEventListener('click', () => {
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenu) {
      mobileMenu.classList.remove('active');
      document.body.style.overflow = '';
    }
  });
});

});

// ===================================================================
// HOMEPAGE HIGHLIGHTS CAROUSEL
// ===================================================================
// Guard legacy highlights logic behind DOM presence to avoid collisions
let currentHighlightIndex = 0;
const totalHighlights = 5; // Total number of highlights
let highlightAutoPlay;

function showHighlight(index) {
  const highlightsSlides = document.querySelectorAll('.highlights-slide');
    const navDots = document.querySelectorAll('.nav-dot');
  if (!highlightsSlides.length) return; // run only on pages with legacy highlights markup
    
    currentHighlightIndex = index;
    
  // Hide all slides with transition
  highlightsSlides.forEach((slide, i) => {
    slide.style.transition = 'opacity 0.7s, transform 0.7s';
    slide.style.opacity = '0';
    slide.style.transform = 'translateX(' + (i < index ? '-40px' : '40px') + ')';
    slide.classList.remove('active');
  });

  // Show current slide with fade/slide in
  if (highlightsSlides[index]) {
    highlightsSlides[index].classList.add('active');
    setTimeout(() => {
      highlightsSlides[index].style.opacity = '1';
      highlightsSlides[index].style.transform = 'translateX(0)';
    }, 50);
  }
    
    // Update navigation dots
    navDots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}

function nextHighlight() {
    currentHighlightIndex = (currentHighlightIndex + 1) % totalHighlights;
    showHighlight(currentHighlightIndex);
}

function previousHighlight() {
    currentHighlightIndex = (currentHighlightIndex - 1 + totalHighlights) % totalHighlights;
    showHighlight(currentHighlightIndex);
}

// Auto-play highlights
function startHighlightAutoPlay() {
  highlightAutoPlay = setInterval(() => {
    nextHighlight();
  }, 6500); // Change every 6.5 seconds
}

function stopHighlightAutoPlay() {
    clearInterval(highlightAutoPlay);
}

// Initialize highlights on page load
document.addEventListener('DOMContentLoaded', function() {
  // Only initialize if legacy highlights markup is present
  if (document.querySelector('.highlights-container') && document.querySelector('.highlights-slide')) {
        showHighlight(0);
        startHighlightAutoPlay();
        
        // Pause autoplay on hover
    const highlightsSection = document.querySelector('.material-testing-highlights');
        if (highlightsSection) {
            highlightsSection.addEventListener('mouseenter', stopHighlightAutoPlay);
            highlightsSection.addEventListener('mouseleave', startHighlightAutoPlay);
        }
    }
});

// ===================================================================
// PRODUCTS CAROUSEL FUNCTIONS
// ===================================================================
let currentProductIndex = 0;
let autoProductSlideInterval;

function moveProductsCarousel(direction) {
  const productsTrack = document.getElementById('productsTrack');
  const productCards = document.querySelectorAll('.product-card');
    
  if (!productsTrack || !productCards.length) return;
    
  const totalItems = productCards.length;
  const itemsToShow = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1024 ? 2 : 3);
  const maxIndex = Math.max(0, totalItems - itemsToShow);
    
  currentProductIndex += direction;
    
  // Loop around
  if (currentProductIndex > maxIndex) {
    currentProductIndex = 0;
  } else if (currentProductIndex < 0) {
    currentProductIndex = maxIndex;
  }
    
  const translateX = -(currentProductIndex * (100 / itemsToShow));
  productsTrack.style.transform = `translateX(${translateX}%)`;
}
// === Our Products carousel autoplay ===
// (Place this right after moveProductsCarousel)

function startProductsAutoPlay() {
  if (typeof autoProductSlideInterval !== 'undefined' && autoProductSlideInterval) {
    clearInterval(autoProductSlideInterval);
  }
  autoProductSlideInterval = setInterval(() => moveProductsCarousel(1), 2500); // speed
}

function stopProductsAutoPlay() {
  if (typeof autoProductSlideInterval !== 'undefined' && autoProductSlideInterval) {
    clearInterval(autoProductSlideInterval);
    autoProductSlideInterval = null;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const track = document.getElementById('productsTrack');
  if (!track) return; // only run on pages that have the products carousel

  const container = track.closest('.products-carousel-container');

  // kick off
  startProductsAutoPlay();

  // pause on hover/touch/focus
  ['mouseenter','focusin','touchstart'].forEach(evt =>
    container.addEventListener(evt, stopProductsAutoPlay, { passive: true })
  );
  ['mouseleave','focusout','touchend'].forEach(evt =>
    container.addEventListener(evt, startProductsAutoPlay, { passive: true })
  );

  // pause when tab is hidden
  document.addEventListener('visibilitychange', () => {
    document.hidden ? stopProductsAutoPlay() : startProductsAutoPlay();
  });

  // keep layout correct on resize (optional)
  window.addEventListener('resize', () => moveProductsCarousel(0));
});

// ===================================================================
// GENERAL CAROUSEL FUNCTIONS (for news/testimonials)

// ---- Safer image switcher ----
function showBlogSlideshowImageSafe(state, idx) {
  const { images, imgEl, dots } = state;
  if (!imgEl || !images || images.length === 0) return;
  const i = ((idx % images.length) + images.length) % images.length;
  state.index = i;

  // swap image
  imgEl.src = images[i];

  // update dots
  if (dots && dots.length) {
    dots.forEach((d, k) => d.classList.toggle('active', k === i));
  }
}

// ---- Utilities ----
function parseSlideshowImages(container) {
  const raw = container.getAttribute('data-images') || '[]';
  try {
    // normalize backslashes to forward slashes before parsing
    const fixed = raw.replace(/\\/g, '/');
    const arr = JSON.parse(fixed);
    return Array.isArray(arr) ? arr.filter(Boolean) : [];
  } catch (e) {
    console.warn('[slideshow] Bad data-images JSON:', raw, e);
    return [];
  }
}

function buildDots(dotsEl, n) {
  if (!dotsEl) return [];
  dotsEl.innerHTML = '';
  const dots = [];
  for (let i = 0; i < n; i++) {
    const d = document.createElement('span');
    d.className = 'slideshow-dot' + (i === 0 ? ' active' : '');
    d.setAttribute('tabindex', '0');
    d.setAttribute('role', 'button');
    d.setAttribute('aria-label', `Go to image ${i + 1}`);
    d.addEventListener('click', function(e) {
      e.stopPropagation();
      // Find the slideshow container and state
      const container = dotsEl.closest('.slideshow-container');
      if (!container) return;
      if (container._slideshowState) {
        showBlogSlideshowImage(container._slideshowState, i);
      }
    });
    dotsEl.appendChild(d);
    dots.push(d);
  }
  return dots;
}

// ---- Safer image switcher ----
function showBlogSlideshowImage(state, idx) {
  const { images, imgEl, dots } = state;
  if (!imgEl || !images || images.length === 0) return;   // nothing to do
  const i = ((idx % images.length) + images.length) % images.length; // safe modulo
  state.index = i;

  // Only animate if there are multiple images
  if (images.length > 1) {
    imgEl.style.transition = 'none';
    imgEl.style.transform = 'translateX(100%)';
    setTimeout(() => {
      imgEl.src = images[i];
      imgEl.onload = () => {
        imgEl.style.transition = 'transform 0.7s cubic-bezier(0.4,0,0.2,1)';
        imgEl.style.transform = 'translateX(0)';
      };
    }, 50);
  } else {
    imgEl.src = images[i];
    imgEl.style.transition = '';
    imgEl.style.transform = '';
  }

  // update dots
  if (dots && dots.length) {
    dots.forEach((d, k) => d.classList.toggle('active', k === i));
  }
}

// ---- Start slideshow on a container ----
function startBlogSlideshow(container) {
  const imgEl  = container.querySelector('.slideshow-img');
  const dotsEl = container.querySelector('.slideshow-dots');
  const images = parseSlideshowImages(container);
  const delay  = parseInt(container.getAttribute('data-delay'), 10) || 2200;

  // If required nodes or images are missing, skip quietly
  if (!imgEl || images.length === 0) {
    container.classList.add('slideshow-disabled');
    return;
  }

  const dots = buildDots(dotsEl, images.length);
  const state = { images, imgEl, dots, index: 0 };
  container._slideshowState = state;
  // initial frame
  showBlogSlideshowImage(state, 0);

  // cycle
  let timer = setInterval(() => {
    showBlogSlideshowImage(state, state.index + 1);
  }, delay);

  // optional: pause on hover
  container.addEventListener('mouseenter', () => clearInterval(timer));
  container.addEventListener('mouseleave', () => {
    clearInterval(timer);
    timer = setInterval(() => {
      showBlogSlideshowImage(state, state.index + 1);
    }, delay);
  });
}

// ---- Auto-init for all slideshows on the page ----
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.slideshow-container').forEach(startBlogSlideshow);
  // Ensure green buttons are always clickable for posts with multiple images
  document.querySelectorAll('.expand-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      // If button has href, open in new tab
      if (btn.href) {
        window.open(btn.href, '_blank');
      } else if (btn.hasAttribute('data-modal')) {
        // If modal logic, trigger modal
        const modalId = btn.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.add('active');
      }
    });
  });
});

// ===================================================================
let currentCarouselIndex = 0;

function moveCarousel(direction) {
    // Check for partners carousel first
    const partnersTrack = document.getElementById('partnersTrack');
    if (partnersTrack) {
        const partnerItems = document.querySelectorAll('.partner-item');
        if (partnerItems.length > 0) {
            const totalItems = partnerItems.length;
            const itemsToShow = window.innerWidth <= 768 ? 2 : (window.innerWidth <= 1024 ? 3 : 4);
            const maxIndex = Math.max(0, totalItems - itemsToShow);
            
            currentCarouselIndex += direction;
            
            // Loop around
            if (currentCarouselIndex > maxIndex) {
                currentCarouselIndex = 0;
            } else if (currentCarouselIndex < 0) {
                currentCarouselIndex = maxIndex;
            }
            
            const translateX = -(currentCarouselIndex * (100 / itemsToShow));
            partnersTrack.style.transform = `translateX(${translateX}%)`;
            return;
        }
    }
    
    // Fallback to general carousel
    const carouselTrack = document.getElementById('carouselTrack');
    const carouselItems = document.querySelectorAll('.carousel-item, .testimonial-item');
    
    if (!carouselTrack || !carouselItems.length) return;
    
    const totalItems = carouselItems.length;
    const itemsToShow = window.innerWidth <= 768 ? 1 : 2;
    const maxIndex = Math.max(0, totalItems - itemsToShow);
    
    currentCarouselIndex += direction;
    
    // Loop around
    if (currentCarouselIndex > maxIndex) {
        currentCarouselIndex = 0;
    } else if (currentCarouselIndex < 0) {
        currentCarouselIndex = maxIndex;
    }
    
    const translateX = -(currentCarouselIndex * (100 / itemsToShow));
    carouselTrack.style.transform = `translateX(${translateX}%)`;
}

// ===================================================================
// NEWS MODAL FUNCTIONS (if still needed)
// ===================================================================
function closeNewsModal() {
    const modal = document.querySelector('.news-modal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// ===================================================================
// ABOUT PAGE TAB FUNCTIONS
// ===================================================================
function showTab(tabId) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.remove('active'));
    
    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => btn.classList.remove('active'));
    
    // Show selected tab content
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.classList.add('active');
    }
    
    // Add active class to clicked tab button
    const clickedButton = document.querySelector(`[onclick="showTab('${tabId}')"]`);
    if (clickedButton) {
        clickedButton.classList.add('active');
    }
}

// ===================================================================
// SERVICES PAGE ACCORDION FUNCTIONS
// ===================================================================
function toggleEquipment(equipmentId) {
    const content = document.getElementById(equipmentId);
    const header = document.querySelector(`[onclick="toggleEquipment('${equipmentId}')"]`);
    
    if (!content || !header) return;
    
    const icon = header.querySelector('.equipment-accordion-icon');
    
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        if (icon) icon.textContent = '−';
        header.classList.add('active');
    } else {
        content.style.display = 'none';
        if (icon) icon.textContent = '+';
        header.classList.remove('active');
    }
}

// ===================================================================
// NEWS PAGE SLIDESHOW FUNCTIONS
// ===================================================================
let slideIndex = 1;
let employeeSlideIndex = 1;

function changeSlide(direction) {
    const container = document.querySelector('.slideshow-container:not(.employee-recognition-slides)');
    if (!container) return;
    
    const slides = container.querySelectorAll('.slide');
    const indicators = container.querySelectorAll('.indicator');
    
    slideIndex += direction;
    
    if (slideIndex > slides.length) slideIndex = 1;
    if (slideIndex < 1) slideIndex = slides.length;
    
    showSlide(slideIndex, container);
}

function currentSlide(index) {
    const container = document.querySelector('.slideshow-container:not(.employee-recognition-slides)');
    if (!container) return;
    
    slideIndex = index;
    showSlide(slideIndex, container);
}

function showSlide(index, container) {
    if (!container) {
        container = document.querySelector('.slideshow-container:not(.employee-recognition-slides)');
    }
    if (!container) return;
    
    const slides = container.querySelectorAll('.slide');
    const indicators = container.querySelectorAll('.indicator');
    
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    if (slides[index - 1]) slides[index - 1].classList.add('active');
    if (indicators[index - 1]) indicators[index - 1].classList.add('active');
}

// Employee Recognition Slideshow
function changeEmployeeSlide(direction) {
    const container = document.querySelector('.employee-recognition-slides');
    if (!container) return;
    
    const slides = container.querySelectorAll('.slide');
    const indicators = container.querySelectorAll('.indicator');
    
    employeeSlideIndex += direction;
    
    if (employeeSlideIndex > slides.length) employeeSlideIndex = 1;
    if (employeeSlideIndex < 1) employeeSlideIndex = slides.length;
    
    showEmployeeSlide(employeeSlideIndex, container);
}

function currentEmployeeSlide(index) {
    const container = document.querySelector('.employee-recognition-slides');
    if (!container) return;
    
    employeeSlideIndex = index;
    showEmployeeSlide(employeeSlideIndex, container);
}

function showEmployeeSlide(index, container) {
    if (!container) {
        container = document.querySelector('.employee-recognition-slides');
    }
    if (!container) return;
    
    const slides = container.querySelectorAll('.slide');
    const indicators = container.querySelectorAll('.indicator');
    
    slides.forEach(slide => slide.style.display = 'none');
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    if (slides[index - 1]) slides[index - 1].style.display = 'block';
    if (indicators[index - 1]) indicators[index - 1].classList.add('active');
}

// Initialize slideshows
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelectorAll('.news-slide').length > 0) {
        showSlide(1);
    }
    if (document.querySelectorAll('.employee-slide').length > 0) {
        showEmployeeSlide(1);
    }
});

// ===================================================================
// EXPANDABLE PRODUCT SPECIFICATIONS (for aggregates page)
// ===================================================================
function toggleSpecs(specsId) {
    const specsDiv = document.getElementById(specsId);
    const btn = specsDiv.previousElementSibling.querySelector('.expand-btn');
    
    if (specsDiv.style.display === 'none' || specsDiv.style.display === '') {
        specsDiv.style.display = 'block';
        btn.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Specifications';
        btn.classList.add('expanded');
    } else {
        specsDiv.style.display = 'none';
        btn.innerHTML = '<i class="fas fa-chevron-down"></i> View Specifications';
        btn.classList.remove('expanded');
    }
}

// ===================================================================
// RESPONSIVE BEHAVIOR
// ===================================================================
window.addEventListener('resize', function() {
    // Update carousel displays on window resize
    if (typeof currentProductIndex !== 'undefined') {
        moveProductsCarousel(0); // Refresh product carousel
    }
    if (typeof currentCarouselIndex !== 'undefined') {
        moveCarousel(0); // Refresh general carousel
    }
});

// ===================================================================
// UTILITY FUNCTIONS
// ===================================================================

// Close mobile menus when clicking outside
document.addEventListener('click', function(e) {
    const navList = document.querySelector('.nav-list');
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    
    // Close main nav if clicking outside
    if (navList && !e.target.closest('.nav') && navList.classList.contains('mobile-active')) {
        navList.classList.remove('mobile-active');
        if (hamburger) hamburger.classList.remove('active');
    }
    
    // Close mobile overlay menu if clicking outside
    if (mobileMenu && !e.target.closest('.mobile-menu-content') && !e.target.closest('.hamburger')) {
        if (mobileMenu.classList.contains('active')) {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
});

// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    
    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
if (!targetId || targetId === '#') return; // iwas querySelector('#')

const targetElement = document.querySelector(targetId);
if (targetElement) {
  e.preventDefault();
  targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
        });
    });
});

// Add keyboard navigation for highlights
document.addEventListener('DOMContentLoaded', function() {
    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            previousHighlight();
        } else if (e.key === 'ArrowRight') {
            nextHighlight();
        }
    });
});

// Product Categories Showcase Functions
function showCategory(categoryId) {
    // Check if elements exist first
    const allContents = document.querySelectorAll('.category-content');
    const allButtons = document.querySelectorAll('.category-nav-btn');
    
    // If these elements don't exist (section was removed), exit the function
    if (allContents.length === 0 || allButtons.length === 0) return;
    
    // Hide all category contents
    allContents.forEach(content => {
        content.classList.remove('active');
    });
    
    // Remove active class from all buttons
    allButtons.forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected category
    const selectedContent = document.getElementById(categoryId);
    if (selectedContent) {
        selectedContent.classList.add('active');
    }
    
    // Add active class to clicked button
    const clickedButton = event ? event.target.closest('.category-nav-btn') : document.querySelector(`.category-nav-btn[onclick*="${categoryId}"]`);
    if (clickedButton) {
        clickedButton.classList.add('active');
    }
}

// News Modal Functions
const newsData = {
    'iso-training': {
        title: 'ISO 9001:2015 Quality Management Training',
        image: 'images/news/GEItrainingiso9001-1024x768.jpg',
        date: 'September 1, 2025',
        content: `
            <p>Gemarc Enterprises Incorporated successfully completed comprehensive training on ISO 9001:2015 Quality Management Systems. This training program was designed to enhance our understanding and implementation of quality management principles across all aspects of our operations.</p>
            
            <p>The training covered key areas including:</p>
            <ul>
                <li>Quality Management System documentation and implementation</li>
                <li>Process approach and risk-based thinking</li>
                <li>Customer satisfaction and continuous improvement</li>
                <li>Internal audit procedures and management review processes</li>
                <li>Corrective and preventive action methodologies</li>
            </ul>
            
            <p>This certification reinforces our commitment to delivering exceptional quality in our testing equipment, calibration services, and customer support. Our team is now better equipped to ensure that all our processes meet the highest international standards.</p>
            
            <p>The ISO 9001:2015 certification will help us maintain consistency in our service delivery while continuously improving our operations to better serve our clients in the construction and testing industry.</p>
        `
    },
    'new-equipment': {
        title: 'Latest Calibration Equipment Arrival',
        image: 'images/focused-industrial-engineer-using-calibration-600nw-2462349429.webp',
        date: 'August 28, 2025',
        content: `
            <p>We are excited to announce the arrival of our latest state-of-the-art calibration equipment. This new addition to our laboratory significantly enhances our testing capabilities and improves the accuracy of our measurement services.</p>
            
            <p>The new equipment features:</p>
            <ul>
                <li>Advanced digital measurement systems with enhanced precision</li>
                <li>Automated calibration processes for improved efficiency</li>
                <li>Multi-parameter testing capabilities for comprehensive analysis</li>
                <li>Enhanced data logging and reporting functions</li>
                <li>Compliance with the latest international testing standards</li>
            </ul>
            
            <p>This investment demonstrates our ongoing commitment to providing our clients with the most accurate and reliable testing services. The new equipment allows us to offer faster turnaround times while maintaining the highest levels of precision and quality.</p>
            
            <p>Our technical team has completed extensive training on the new equipment to ensure optimal operation and maximum benefit for our clients. We look forward to delivering even better service quality with these technological advancements.</p>
        `
    },
    'partnership': {
        title: 'Expanding Our Partnership Network',
        image: 'images/technicianinstrument-technician-on-job-calibrate-600nw-1020417871.webp',
        date: 'August 25, 2025',
        content: `
            <p>Gemarc Enterprises continues to strengthen its position in the testing and calibration industry by expanding our network of strategic partnerships with leading global manufacturers and technology providers.</p>
            
            <p>Our enhanced partnership network includes:</p>
            <ul>
                <li>Advanced testing equipment manufacturers from Europe and Asia</li>
                <li>Specialized calibration service providers</li>
                <li>Technology innovators in digital measurement systems</li>
                <li>Quality assurance and compliance specialists</li>
                <li>Research and development institutions</li>
            </ul>
            
            <p>These partnerships enable us to offer our clients access to the latest technologies, innovative testing solutions, and comprehensive support services. By working closely with industry leaders, we ensure that our clients benefit from cutting-edge equipment and methodologies.</p>
            
            <p>The expanded network also allows us to provide more comprehensive training programs, technical support, and maintenance services. This collaborative approach helps us deliver superior value to our clients while staying at the forefront of industry developments.</p>
        `
    }
};

function openNewsModal(newsId) {
    const modal = document.getElementById('newsModal');
    const modalContent = document.getElementById('modalContent');
    const news = newsData[newsId];
    
    if (!news) return;
    
    modalContent.innerHTML = `
        <h2>${news.title}</h2>
        <img src="${news.image}" alt="${news.title}" style="width: 100%; max-width: 600px; height: auto; border-radius: 10px; margin: 20px 0;">
        <div style="line-height: 1.6; color: #555;">
            ${news.content}
        </div>
    `;
    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeNewsModal() {
    const modal = document.getElementById('newsModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('newsModal');
    if (event.target === modal) {
        closeNewsModal();
    }
});

// Product Showcase Functions
let showcaseCurrentSlide = 0;
const showcaseItemsPerSlide = 4;

function moveShowcase(direction) {
    const track = document.getElementById('showcaseTrack');
    
    // Check if showcase track exists (only on index page)
    if (!track) {
        return;
    }
    
    const items = track.children;
    const totalItems = items.length;
    const maxSlides = Math.ceil(totalItems / showcaseItemsPerSlide);
    
    showcaseCurrentSlide += direction;
    
    if (showcaseCurrentSlide >= maxSlides) {
        showcaseCurrentSlide = 0;
    } else if (showcaseCurrentSlide < 0) {
        showcaseCurrentSlide = maxSlides - 1;
    }
    
    const translateX = -(showcaseCurrentSlide * 100);
    track.style.transform = `translateX(${translateX}%)`;
    
    updateShowcaseDots();
}

function currentShowcaseSlide(n) {
    showcaseCurrentSlide = n - 1;
    const track = document.getElementById('showcaseTrack');
    const translateX = -(showcaseCurrentSlide * 100);
    track.style.transform = `translateX(${translateX}%)`;
    
    updateShowcaseDots();
}

function updateShowcaseDots() {
    const dots = document.querySelectorAll('.showcase-dots .dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === showcaseCurrentSlide);
    });
}

// Auto-play showcase
function autoPlayShowcase() {
    // Check if showcase exists before starting auto-play
    const track = document.getElementById('showcaseTrack');
    if (!track) {
        return;
    }
    
    setInterval(() => {
        moveShowcase(1);
    }, 5000); // Change slide every 5 seconds
}

// Initialize showcase functionality
document.addEventListener('DOMContentLoaded', function() {
    // Only start auto-play if showcase exists
    const track = document.getElementById('showcaseTrack');
    if (track) {
        autoPlayShowcase();
    }
    
    // Handle responsive behavior
    function handleShowcaseResize() {
        const items = document.querySelectorAll('.product-item');
        const windowWidth = window.innerWidth;
        
        let itemsPerSlide;
        if (windowWidth <= 768) {
            itemsPerSlide = 2;
        } else if (windowWidth <= 1024) {
            itemsPerSlide = 3;
        } else {
            itemsPerSlide = 4;
        }
        
        // Update global variable
        window.showcaseItemsPerSlide = itemsPerSlide;
        
        // Reset to first slide on resize
        showcaseCurrentSlide = 0;
        const track = document.getElementById('showcaseTrack');
        if (track) {
            track.style.transform = 'translateX(0%)';
            updateShowcaseDots();
        }
    }
    
    // Call on load and resize
    handleShowcaseResize();
    window.addEventListener('resize', handleShowcaseResize);
});

// Calibration Slideshow Functions
let currentCalibration = 0;
const calibrationSlides = document.querySelectorAll('.calibration-slide');
const calibrationDots = document.querySelectorAll('.cal-nav-dot');

// Initialize calibration slideshow
document.addEventListener('DOMContentLoaded', function() {
    if (calibrationSlides.length > 0) {
        showCalibration(0);
        
        // Start autoplay
        let calibrationInterval = setInterval(function() {
            nextCalibration();
        }, 3500); // Change slide every 3.5 seconds
        
        // Pause on hover
        const calibrationCarousel = document.querySelector('.calibration-carousel');
        if (calibrationCarousel) {
            calibrationCarousel.addEventListener('mouseenter', function() {
                clearInterval(calibrationInterval);
            });
            
            calibrationCarousel.addEventListener('mouseleave', function() {
                calibrationInterval = setInterval(function() {
                    nextCalibration();
                }, 3500);
            });
        }
        
        // Touch events for mobile swipe
        let touchStartX = 0;
        let touchEndX = 0;
        
        if (calibrationCarousel) {
            calibrationCarousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, false);
            
            calibrationCarousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, false);
        }
        
        function handleSwipe() {
            if (touchEndX < touchStartX) {
                nextCalibration(); // Swipe left
            } else if (touchEndX > touchStartX) {
                previousCalibration(); // Swipe right
            }
        }
    }
});

function showCalibration(slideIndex) {
    if (calibrationSlides.length === 0) return;
    
    // Hide all slides
    calibrationSlides.forEach(slide => {
        slide.classList.remove('active');
    });
    
    // Remove active class from all dots
    calibrationDots.forEach(dot => {
        dot.classList.remove('active');
    });
    
    // Show selected slide
    currentCalibration = slideIndex;
    
    // Handle index boundaries
    if (currentCalibration >= calibrationSlides.length) {
        currentCalibration = 0;
    } else if (currentCalibration < 0) {
        currentCalibration = calibrationSlides.length - 1;
    }
    
    // Add active class to current slide and dot
    calibrationSlides[currentCalibration].classList.add('active');
    calibrationDots[currentCalibration].classList.add('active');
}

function nextCalibration() {
    showCalibration(currentCalibration + 1);
}

function previousCalibration() {
    showCalibration(currentCalibration - 1);
}

// Equipment Accordion Toggle Function
function toggleEquipment(equipmentId) {
    const content = document.getElementById(equipmentId + '-content');
    const icon = document.getElementById(equipmentId + '-icon');
    
    // Close all other accordion items
    const allContents = document.querySelectorAll('.equipment-accordion-content');
    const allIcons = document.querySelectorAll('.accordion-icon');
    
    allContents.forEach(otherContent => {
        if (otherContent !== content) {
            otherContent.classList.remove('open');
        }
    });
    
    allIcons.forEach(otherIcon => {
        if (otherIcon !== icon) {
            otherIcon.classList.remove('rotated');
        }
    });
    
    // Toggle current accordion item
    content.classList.toggle('open');
    icon.classList.toggle('rotated');
}

// ===================================================================
// MODAL SYSTEM - ALWAYS CENTERED POPUPS
// ===================================================================

// Open product modal
function openProductModal(productData) {
    const modalOverlay = document.getElementById('productModal');
    if (!modalOverlay) return;
    
    // Update modal content
    document.getElementById('modalProductCode').textContent = productData.code;
    document.getElementById('modalProductCodeSub').textContent = productData.code;
    document.getElementById('modalProductName').textContent = productData.name;
    document.getElementById('modalProductStandard').textContent = productData.standard;
    document.getElementById('modalProductDescription').textContent = productData.description;
    document.getElementById('modalProductImage').src = productData.image;
    document.getElementById('modalProductImage').alt = productData.name;

    
    // Update email button subject
    const emailBtn = document.getElementById('modalEmailBtn');
    if (emailBtn && productData.code) {
        emailBtn.href = `mailto:info@gemarcenterprises.com?subject=Inquiry about Product Code: ${productData.code}`;
    }
    
    // Update specifications
    const specsGrid = document.getElementById('modalSpecsGrid');
    specsGrid.innerHTML = '';
    
    productData.specs.forEach(spec => {
        const specItem = document.createElement('div');
        specItem.className = 'modal-spec-item';
        specItem.innerHTML = `
            <span class="modal-spec-label">${spec.label}:</span>
            <span class="modal-spec-value">${spec.value}</span>
        `;
        specsGrid.appendChild(specItem);
    });
    // SET "View PDF Specs" button (inside openProductModal)
const pdfBtn = document.getElementById('modalSpecLink');
if (pdfBtn) {
  if (productData.pdf && productData.pdf.trim()) {
    // encode para hindi sumablay kapag may spaces/underscores
    pdfBtn.href = encodeURI(productData.pdf);
    pdfBtn.style.display = 'inline-flex';
    pdfBtn.onclick = null; // siguraduhing walang preventDefault
  } else {
    pdfBtn.removeAttribute('href');
    pdfBtn.style.display = 'none';
    pdfBtn.onclick = (e) => e.preventDefault();
  }
}

    // Show modal
    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Add keyboard event listener for ESC key
    document.addEventListener('keydown', handleModalKeydown);
    
    // Ensure modal is scrolled into view (for small screens)
    setTimeout(function() {
        const modalContent = modalOverlay.querySelector('.modal-content');
        if (modalContent) {
            modalContent.scrollIntoView({behavior: 'auto', block: 'center'});
        }
    }, 50);
}

// Close product modal
function closeProductModal() {
    const modalOverlay = document.getElementById('productModal');
    if (modalOverlay) {
        // Fade out animation
        modalOverlay.style.opacity = '0';
        modalOverlay.style.transition = 'opacity 0.25s ease-out';
        
        // Remove keyboard event listener
        document.removeEventListener('keydown', handleModalKeydown);
        
        setTimeout(() => {
            modalOverlay.classList.remove('active');
            modalOverlay.style.opacity = '';
            modalOverlay.style.transition = '';
            document.body.style.overflow = '';
        }, 250);
    }
}

// Handle keyboard events for modal (only when modal is active)
function handleModalKeydown(event) {
    if (event.key === 'Escape') {
        closeProductModal();
    }
}

// Enhanced modal click handling
document.addEventListener('click', function(e) {
    const modal = document.getElementById('productModal');
    if (!modal || !modal.classList.contains('active')) return;
    
    // If clicking the overlay background (not the content)
    if (e.target === modal) {
        closeProductModal();
    }
});

// Prevent modal content clicks from closing the modal
document.addEventListener('DOMContentLoaded', function() {
    const modalContent = document.querySelector('#productModal .modal-content');
    if (modalContent) {
        modalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});

// News dropdown functionality
function toggleNewsContent(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.dropdown-icon i');
    
    if (content.classList.contains('collapsed')) {
        content.classList.remove('collapsed');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        header.querySelector('.dropdown-icon').classList.add('rotated');
    } else {
        content.classList.add('collapsed');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
        header.querySelector('.dropdown-icon').classList.remove('rotated');
    }
}

// ===================================================================
// CALIBRATION GALLERY FUNCTIONS
// ===================================================================
function toggleGalleryContent(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.dropdown-icon i');
    
    if (content.classList.contains('collapsed')) {
        content.classList.remove('collapsed');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        header.querySelector('.dropdown-icon').classList.add('rotated');
    } else {
        content.classList.add('collapsed');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
        header.querySelector('.dropdown-icon').classList.remove('rotated');
    }
}

function openImageModal(img) {
window.openImageModal = openImageModal;
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    
    modal.style.display = 'block';
    modalImg.src = img.src;
    modalImg.alt = img.alt;
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

// Close modal function (safe kahit wala ang #imageModal)
function closeImageModal() {
  const modal = document.getElementById('imageModal');
  if (!modal) return;                  // <-- guard para di mag-error
  modal.style.display = 'none';
  document.body.style.overflow = '';   // restore scroll
}
// gawing available globally kung may inline onclick
window.closeImageModal = closeImageModal;

// Close modal when clicking outside the image + Esc key
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('imageModal');
  if (!modal) return;                  // <-- huwag mag-setup ng listeners kung wala

  modal.addEventListener('click', function (e) {
    if (e.target === modal) {
      closeImageModal();
    }
  });

  // Close modal with Escape key (activate lang kung may modal)
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeImageModal();
    }
  });
});
// === Partners carousel autoplay (uses your existing moveCarousel) ===
document.addEventListener('DOMContentLoaded', () => {
  const track = document.getElementById('partnersTrack');
  if (!track) return;

  const container = track.closest('.partners-carousel-container');
  let timer = null;

  function startAuto() { stopAuto(); timer = setInterval(() => moveCarousel(1), 2500); }
  function stopAuto()  { if (timer) { clearInterval(timer); timer = null; } }

  startAuto();

  // pause on hover/focus, resume on leave
  ['mouseenter','focusin','touchstart'].forEach(evt =>
    container.addEventListener(evt, stopAuto, {passive:true})
  );
  ['mouseleave','focusout','touchend'].forEach(evt =>
    container.addEventListener(evt, startAuto, {passive:true})
  );

  // pause when tab is hidden (saves CPU)
  document.addEventListener('visibilitychange', () => {
    document.hidden ? stopAuto() : startAuto();
  });
});
// ===== GEMARC Inline Inquiry - initializer (multi-modal support) =====
document.addEventListener('DOMContentLoaded', function () {
  // Render rows + wire up events for every .gem-inquiry
  document.querySelectorAll('.gem-inquiry').forEach(container => {
    const emailsAttr = (container.getAttribute('data-emails') || '').trim();
    const emails = emailsAttr.split(',').map(e => e.trim()).filter(Boolean);
    const panel = container.querySelector('.js-inquiry-panel');
    const btn   = container.querySelector('.js-show-inquiry');

    // Build the panel only once
    if (panel && !panel.dataset.rendered) {
      let html = '<p class="inquiry-help">You can send your inquiries to any of the emails below:</p>';
      emails.forEach(mail => {
        html += `
          <div class="inquiry-email-row">
            <span class="inquiry-email">${mail}</span>
            <button type="button" class="inquiry-copy" data-email="${mail}">Copy</button>
          </div>`;
      });
      html += `
        <div class="inquiry-note">
          Prefer your mail app? <a class="inquiry-mailto" href="mailto:${encodeURIComponent(emails[0] || 'sales@gemarcph.com')}">Open mail app</a>
        </div>`;
      panel.innerHTML = html;
      panel.dataset.rendered = '1';
    }

    // Toggle show/hide
    if (btn && panel) {
      btn.addEventListener('click', () => {
        const hidden = panel.hasAttribute('hidden');
        if (hidden) {
          panel.removeAttribute('hidden');
          btn.classList.add('active');
          btn.innerHTML = '<i class="fas fa-envelope-open-text"></i> Show Less';
        } else {
          panel.setAttribute('hidden', '');
          btn.classList.remove('active');
          btn.innerHTML = '<i class="fas fa-envelope"></i> Send Inquiry';
        }
      });
    }

    // Delegate copy buttons inside this panel
    panel?.addEventListener('click', async (ev) => {
      const target = ev.target.closest('.inquiry-copy');
      if (!target) return;
      const email = target.getAttribute('data-email') || '';
      try {
        await navigator.clipboard.writeText(email);
        const prev = target.textContent;
        target.textContent = 'Copied!';
        setTimeout(() => { target.textContent = prev; }, 1200);
      } catch {
        alert('Copy failed. Please select and copy:\n' + email);
      }
    });
  });
});
/* ===== Search Suggestions for .products-search .search-input (multi-instance) ===== */
document.addEventListener('DOMContentLoaded', () => {
  // Build one shared index of all product cards on the page
  function buildProductIndex() {
    const cards = document.querySelectorAll('.product-card, [data-product-card]');
    const list = [];
    cards.forEach(card => {
      const name = card.querySelector('.product-name, [data-product-name]')?.textContent.trim() || '';
      const code = card.querySelector('.product-code, [data-product-code]')?.textContent.trim() || '';
      const std  = card.querySelector('.product-standard, [data-product-standard]')?.textContent.replace(/^Standard:\s*/i,'').trim() || '';
      const desc = card.querySelector('.product-description, [data-product-desc]')?.textContent.trim() || '';
      const img  = card.querySelector('img')?.getAttribute('src') || '';
      if (name || code) list.push({ name, code, standard: std, description: desc, image: img, card });
    });
    return list;
  }
  let index = buildProductIndex();

  // Init each search bar on the page
  document.querySelectorAll('.products-search .search-input').forEach(initSearchBox);

  // Rebuild index when everything is loaded (images, etc.)
  window.addEventListener('load', () => { index = buildProductIndex(); });

  function initSearchBox(input) {
    const wrap = input.closest('.products-search');
    if (!wrap) return;

    // Create dropdown
    const dd = document.createElement('div');
    dd.className = 'search-suggest';
    wrap.appendChild(dd);

    let active = -1;
    let results = [];

    const escapeHtml = (s) => String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
    const escapeReg  = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const highlight  = (text, q) => {
      if (!text) return '';
      try {
        const re = new RegExp(`(${escapeReg(q)})`, 'ig');
        return escapeHtml(text).replace(re, '<mark>$1</mark>');
      } catch { return escapeHtml(text); }
    };

    function scoreAndFilter(list, q) {
      if (!q) return list.slice(0, 8);
      const Q = q.toLowerCase();
      const r = [];
      for (const item of list) {
        const name = item.name.toLowerCase();
        const code = item.code.toLowerCase();
        const std  = (item.standard || '').toLowerCase();
        let score = Infinity;
        if (code.includes(Q)) score = Math.min(score, code.indexOf(Q));
        if (name.includes(Q)) score = Math.min(score, name.indexOf(Q));
        if (std.includes(Q))  score = Math.min(score, std.indexOf(Q));
        if (score !== Infinity) r.push({ ...item, _score: score });
      }
      return r.sort((a,b) => a._score - b._score || (a.code > b.code ? 1 : -1)).slice(0, 8);
    }

    function render(q) {
      results = scoreAndFilter(index, q);
      if (!results.length) { dd.classList.remove('show'); dd.innerHTML = ''; return; }
      dd.innerHTML = results.map((r, i) => `
        <div class="search-suggest-item" data-i="${i}">
          <img class="search-suggest-thumb" src="${escapeHtml(r.image || '')}" alt="">
          <div>
            <div class="search-suggest-title">${highlight(r.name || '', q)}</div>
            <div class="search-suggest-meta">${highlight(r.standard || '', q)}</div>
          </div>
          <div class="search-suggest-code">${highlight(r.code || '', q)}</div>
        </div>
      `).join('');
      dd.classList.add('show');
    }

    // show on focus (top items), filter on input
    const DEBOUNCE = 120;
    let t;
    input.addEventListener('focus', () => { active = -1; render((input.value || '').trim().toLowerCase()); });
    input.addEventListener('input', () => { clearTimeout(t); t = setTimeout(() => {
      active = -1; render((input.value || '').trim().toLowerCase());
    }, DEBOUNCE); });

    // click suggestion
    dd.addEventListener('click', (e) => {
      const item = e.target.closest('.search-suggest-item');
      if (!item) return;
      selectResult(results[Number(item.dataset.i)]);
    });

    // keyboard: arrows, enter, esc
    input.addEventListener('keydown', (e) => {
      if (!dd.classList.contains('show')) return;
      const items = Array.from(dd.querySelectorAll('.search-suggest-item'));
      if (!items.length) return;

      if (e.key === 'ArrowDown') { e.preventDefault(); active = (active + 1) % items.length; updateActive(items); }
      else if (e.key === 'ArrowUp') { e.preventDefault(); active = (active - 1 + items.length) % items.length; updateActive(items); }
      else if (e.key === 'Enter') { e.preventDefault(); selectResult(active >= 0 ? results[active] : results[0]); }
      else if (e.key === 'Escape') { dd.classList.remove('show'); }
    });

    // click outside to close
    document.addEventListener('click', (e) => {
      if (!dd.contains(e.target) && e.target !== input) dd.classList.remove('show');
    });

    function updateActive(items) {
      items.forEach(el => el.classList.remove('active'));
      if (active >= 0) items[active].classList.add('active');
    }

    function selectResult(item) {
      if (!item) return;
      dd.classList.remove('show');

      // Try to open modal if available
      try {
        if (typeof openProductModal === 'function') {
          openProductModal({
            code: item.code,
            name: item.name,
            standard: item.standard,
            description: item.description,
            image: item.image
          });
          return;
        }
      } catch(e) {}

        // Set PDF link if provided
const pdfBtn = document.getElementById('modalSpecLink');
if (pdfBtn) {
  if (product.pdf && product.pdf.trim()) {
    // Encode spaces para sure na tama kahit may spaces/underscore ang path
    const encoded = encodeURI(product.pdf);
    pdfBtn.href = encoded;
    pdfBtn.style.display = 'inline-flex';
    pdfBtn.onclick = null; // siguraduhin na walang preventDefault handler
  } else {
    // walang pdf => itago para hindi "#"
    pdfBtn.removeAttribute('href');
    pdfBtn.style.display = 'none';
    pdfBtn.onclick = (e) => e.preventDefault();
  }
}

      // Fallback: scroll to card + pulse
      if (item.card?.scrollIntoView) {
        item.card.scrollIntoView({ block: 'center', behavior: 'smooth' });
        item.card.classList.add('card-pulse');
        setTimeout(() => item.card.classList.remove('card-pulse'), 1200);
      }
    }
  }
});


// ===================================================================
// NEWS CARDS MODAL POPUP (works even if the card is inside <a>)
// ===================================================================
(function initNewsCardsModal(){
  function ensureModal() {
    var modal = document.getElementById('newsModal');
    if (modal) return;
    // create minimal modal if missing
    var div = document.createElement('div');
    div.innerHTML = '\
<div id="newsModal" class="news-modal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;">\
  <div class="news-modal-content" style="background:#fff;padding:25px;max-width:700px;width:90%;border-radius:12px;text-align:center;position:relative;">\
    <span class="news-modal-close" style="position:absolute;top:15px;right:20px;font-size:2rem;cursor:pointer;color:#333">&times;</span>\
    <img id="newsModalImage" src="" alt="News Image" style="max-width:100%;border-radius:8px;margin-bottom:20px">\
    <h2 id="newsModalTitle"></h2>\
    <p id="newsModalDesc"></p>\
    <a href="news.html" class="news-modal-btn" style="display:inline-block;margin-top:15px;background:#2e7d32;color:#fff;padding:12px 20px;border-radius:6px;text-decoration:none;font-weight:600">Read Full Article</a>\
  </div>\
</div>';
    document.body.appendChild(div.firstChild);
  }

  function openNewsModalFromCard(card){
    ensureModal();
    var modal = document.getElementById('newsModal');
    var imgEl = document.getElementById('newsModalImage');
    var titleEl = document.getElementById('newsModalTitle');
    var descEl = document.getElementById('newsModalDesc');
    // read preferred data-* attributes, else fallback to DOM
    var img = card.dataset.image || (card.querySelector('img') && card.querySelector('img').getAttribute('src')) || '';
    var title = card.dataset.title || (card.querySelector('h3, h2') && card.querySelector('h3, h2').textContent.trim()) || '';
    var desc = card.dataset.description || (card.querySelector('p') && card.querySelector('p').textContent.trim()) || '';
    if (imgEl) imgEl.src = img;
    if (titleEl) titleEl.textContent = title;
    if (descEl) descEl.textContent = desc;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeModal(){
    var modal = document.getElementById('newsModal');
    if (!modal) return;
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  document.addEventListener('click', function(e){
    // Close when clicking close icon or backdrop
    if (e.target.classList && (e.target.classList.contains('news-modal') || e.target.classList.contains('news-modal-close'))) {
      closeModal();
      return;
    }
  });

  // Capture-phase listener to intercept <a> inside cards (prevents navigation)
  document.addEventListener('click', function(e){
    var card = e.target.closest && e.target.closest('.news-card, .article-card, .blog-card');
    if (!card) return;
    // stop link navigation inside the card
    var link = e.target.closest('a');
    if (link) e.preventDefault();
    e.stopPropagation();
    openNewsModalFromCard(card);
  }, true);

  // ESC to close
  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') closeModal();
  });
})();
// Calibration gallery toggle (for the consolidated showcase)
function toggleCalibGallery(headerEl) {
  const chev = headerEl.querySelector('.chev i');
  const panel = document.getElementById('calibGallery');
  if (!panel) return;
  panel.classList.toggle('collapsed');
  // rotate chevron
  if (panel.classList.contains('collapsed')) {
    chev.classList.remove('fa-chevron-up');
    chev.classList.add('fa-chevron-down');
  } else {
    chev.classList.remove('fa-chevron-down');
    chev.classList.add('fa-chevron-up');
  }
}
// Services gallery toggle (Demos & Trainings)
function toggleSvcGallery(headerEl){
  const chev = headerEl.querySelector('.chev i');
  const panel = document.getElementById('svcGallery');
  if(!panel) return;
  panel.classList.toggle('collapsed');
  if(panel.classList.contains('collapsed')){
    chev.classList.remove('fa-chevron-up');
    chev.classList.add('fa-chevron-down');
  }else{
    chev.classList.remove('fa-chevron-down');
    chev.classList.add('fa-chevron-up');
  }
}
/* ================== CONTACT FORM → GOOGLE SHEETS (FormData, no CORS) ================== */
(function () {
  // 1) PASTE your Apps Script /exec URL here:
  const APPS_SCRIPT_URL = 'https://script.google.com/macros/s/AKfycbz_XH-PjhtH70XSActWihepoEZTsGTwhWijqo7k1qh78lNH-GZ-0nswPRYGWm5UCsV8pA/exec';

  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    const statusDiv = document.getElementById('form-status');
    if (!form) return; // walang form sa page

    // helper to show status
    function showStatus(msg, type) {
      if (!statusDiv) return;
      statusDiv.style.display = 'block';
      statusDiv.textContent = msg;
      statusDiv.style.borderRadius = '6px';
      if (type === 'loading') {
        statusDiv.style.background = '#fff3cd';
        statusDiv.style.color = '#856404';
        statusDiv.style.border = '1px solid #ffeeba';
      } else if (type === 'success') {
        statusDiv.style.background = '#d4edda';
        statusDiv.style.color = '#155724';
        statusDiv.style.border = '1px solid #c3e6cb';
      } else {
        statusDiv.style.background = '#f8d7da';
        statusDiv.style.color = '#721c24';
        statusDiv.style.border = '1px solid #f5c6cb';
      }
    }

    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      const btn = form.querySelector('button[type="submit"]');
      if (btn) { btn.disabled = true; btn.style.opacity = '0.7'; }
      showStatus('Sending...', 'loading');

      // 2) Send as FormData (walang custom headers → walang preflight/CORS)
      const fd = new FormData(form);

      try {
        const res = await fetch(APPS_SCRIPT_URL, { method: 'POST', body: fd, redirect: 'follow' });
        const text = await res.text(); // Apps Script often returns plain text
        // accept 'ok' or JSON {status:"ok"}
        let ok = false;
        try { ok = JSON.parse(text)?.status === 'ok'; } catch (_) { ok = /\bok\b/i.test(text); }

        if (res.ok && ok) {
          showStatus('Thank you! Your message has been recorded.', 'success');
          form.reset();
        } else {
          console.warn('Apps Script response:', text);
          showStatus('There was a problem sending your message. Please try again.', 'error');
        }
      } catch (err) {
        console.error('Contact form error:', err);
        showStatus('Network error. Please check your connection and try again.', 'error');
      } finally {
        if (btn) { btn.disabled = false; btn.style.opacity = ''; }
      }
    });
  });
})();
function doPost(e) {
  var p = e.parameter || {};
  var token = p['g-recaptcha-response'];  // galing sa form

  // Verify with Google reCAPTCHA
  var url = "https://www.google.com/recaptcha/api/siteverify";
  var response = UrlFetchApp.fetch(url, {
    method: "post",
    payload: {
      secret: RECAPTCHA_SECRET,
      response: token
    }
  });
  var result = JSON.parse(response.getContentText());

  if (!result.success) {
    // ❌ Hindi pumasa sa captcha
    return ContentService.createTextOutput(
      JSON.stringify({ status: "captcha_failed" })
    ).setMimeType(ContentService.MimeType.JSON);
  }

  // ✅ Kung pumasa, saka lang i-log sa sheet
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  sheet.appendRow([new Date(), p.fullname, p.email, p.phone, p.message]);

  return ContentService.createTextOutput(
    JSON.stringify({ status: "ok" })
  ).setMimeType(ContentService.MimeType.JSON);
}
