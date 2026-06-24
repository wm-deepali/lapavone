document.addEventListener('DOMContentLoaded', () => {
    // 1. MEGA MENU INTERACTION
    const navShopAll = document.getElementById('nav-shop-all');
    const megaMenu = document.getElementById('mega-menu');
    const navbar = document.querySelector('.lp-navbar');
    let megaMenuTimer;

    if (navShopAll && megaMenu && navbar) {
        // Open when hovering Shop All
        navShopAll.addEventListener('mouseenter', () => {
            if (window.innerWidth >= 992) {
                clearTimeout(megaMenuTimer);
                megaMenu.classList.add('active');
            }
        });

        // Close only when leaving the entire navbar/menu area
        navbar.addEventListener('mouseleave', () => {
            if (window.innerWidth >= 992) {
                megaMenuTimer = setTimeout(() => {
                    megaMenu.classList.remove('active');
                }, 250); // 250ms delay for smooth transition
            }
        });

        // Cancel close if re-entering the navbar/menu area
        navbar.addEventListener('mouseenter', () => {
            if (window.innerWidth >= 992 && megaMenu.classList.contains('active')) {
                clearTimeout(megaMenuTimer);
            }
        });

        // Open on click for mobile
        const shopAllLink = navShopAll.querySelector('a');
        if (shopAllLink) {
            shopAllLink.addEventListener('click', (e) => {
                if (window.innerWidth < 992) {
                    e.preventDefault(); // Prevent navigating immediately
                    megaMenu.classList.toggle('active');
                }
            });
        }

        // Mega menu dynamic right lists on hover
        const leftItems = megaMenu.querySelectorAll('.mega-menu-item');
        const rightLists = megaMenu.querySelectorAll('.mega-menu-right-panels .right-list');
        
        if (leftItems.length > 0 && rightLists.length > 0) {
            leftItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    if (window.innerWidth >= 992) {
                        const targetId = item.getAttribute('data-target');
                        if (targetId) {
                            rightLists.forEach(list => list.style.display = 'none');
                            const targetList = document.getElementById(targetId);
                            if (targetList) targetList.style.display = 'flex';
                        }
                    }
                });
            });
        }
    }

    // 1B. MOBILE MENU TOGGLE
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileNavToggle && navLinks) {
        mobileNavToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // 2. HERO ENTRANCE ANIMATION
    const heroHeading = document.querySelector('.hero-heading');
    const heroButtons = document.querySelector('.hero-buttons');

    // Slight delay to ensure paint
    setTimeout(() => {
        if (heroHeading) heroHeading.classList.add('animate-entrance');
        if (heroButtons) heroButtons.classList.add('animate-entrance');
    }, 100);


    // 3. INTERSECTION OBSERVERS FOR SCROLL ANIMATIONS
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const scrollObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Fragrance Header
                const fadeEl = entry.target.querySelector('.js-fade-in');
                if (fadeEl) fadeEl.classList.add('is-visible');

                // Fragrance Cards
                const cards = entry.target.querySelectorAll('.js-card-slide');
                if (cards.length > 0) {
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('is-visible');
                        }, 500 + (index * 150)); // Wait 500ms for heading, then sequential left -> right
                    });
                }

                // Category Blocks (Men/Women)
                const leftSlide = entry.target.querySelector('.js-slide-left');
                const rightSlide = entry.target.querySelector('.js-slide-right');

                if (leftSlide) leftSlide.classList.add('is-visible-left');
                if (rightSlide) rightSlide.classList.add('is-visible-right');

                // Stop observing once animated
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const observeElements = document.querySelectorAll('.js-observe');
    observeElements.forEach(el => scrollObserver.observe(el));


    // 4. CAROUSEL CONTROLS
    const track = document.getElementById('product-track');
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');

    if (track && btnPrev && btnNext) {
        const getScrollAmount = () => {
            const card = track.querySelector('.product-card');
            if (!card) return 300;
            const gap = parseFloat(window.getComputedStyle(track).gap) || 0;
            return card.offsetWidth + gap;
        };

        btnNext.addEventListener('click', () => {
            track.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
        });

        btnPrev.addEventListener('click', () => {
            track.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
        });
    }


    // 5. PRODUCT CARD INTERACTIONS (WISHLIST, CART & ADD BAG)
    const wishlistBtns = document.querySelectorAll('.btn-wishlist');
    const cartBtns = document.querySelectorAll('.btn-cart, .btn-add-bag');

    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            btn.classList.toggle('active');
        });
    });

    // cartBtns.forEach(btn => {
    //     btn.addEventListener('click', (e) => {
    //         e.preventDefault();
    //         btn.classList.toggle('active');
    //     });
    // });


    // 6. AUDIO BEHAVIOR FOR BANNER 3
    const audioSection = document.getElementById('audio-section');
    const ambientAudio = document.getElementById('ambient-audio');

    // Check if audio source exists
    const hasAudioSource = ambientAudio && ambientAudio.querySelector('source') && ambientAudio.querySelector('source').getAttribute('src');

    if (audioSection && ambientAudio && hasAudioSource) {
        ambientAudio.volume = 0; // start at 0
        let fadeInterval;

        const fadeAudio = (audio, direction) => {
            clearInterval(fadeInterval);
            const step = 0.05;
            const intervalTime = 40; // 40ms per step

            fadeInterval = setInterval(() => {
                try {
                    if (direction === 'in') {
                        let newVol = audio.volume + step;
                        if (newVol >= 1) {
                            audio.volume = 1;
                            clearInterval(fadeInterval);
                        } else {
                            audio.volume = newVol;
                        }
                    } else {
                        let newVol = audio.volume - step;
                        if (newVol <= 0) {
                            audio.volume = 0;
                            audio.pause();
                            audio.currentTime = 0; // Reset to play from beginning next time
                            clearInterval(fadeInterval);
                        } else {
                            audio.volume = newVol;
                        }
                    }
                } catch (e) {
                    console.error('Audio fade error:', e);
                    clearInterval(fadeInterval);
                }
            }, intervalTime);
        };

        const audioObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Start playing and fade in
                    ambientAudio.play().then(() => {
                        fadeAudio(ambientAudio, 'in');
                    }).catch(e => {
                        // Autoplay prevented by browser
                        console.log('Audio autoplay prevented by browser policy.', e);
                    });
                } else {
                    // Fade out and pause
                    if (!ambientAudio.paused) {
                        fadeAudio(ambientAudio, 'out');
                    }
                }
            });
        }, { threshold: 0.3 }); // trigger when 30% visible

        audioObserver.observe(audioSection);
    }

    // 7. HORIZONTAL SCROLL ON VERTICAL SCROLL (ABOUT PAGE)
    const horizSection = document.getElementById('horizontal-scroll-section');
    const horizContainer = document.getElementById('horizontal-scroll-container');

    if (horizSection && horizContainer) {
        // Function to set section height dynamically for perfectly paced scrolling
        const setScrollHeight = () => {
            if (window.innerWidth <= 991) {
                horizSection.style.height = 'auto';
                horizContainer.style.transform = 'none';
                return;
            }
            const maxTranslate = horizContainer.scrollWidth - window.innerWidth;
            // Multiplier controls speed: 1.5 = slower, 1.0 = normal 1:1 speed, 0.5 = faster
            const scrollSpeedMultiplier = 1.5; 
            horizSection.style.height = (maxTranslate * scrollSpeedMultiplier) + window.innerHeight + 'px';
        };

        // Initial set and update on resize
        setScrollHeight();
        window.addEventListener('resize', setScrollHeight);

        window.addEventListener('scroll', () => {
            if (window.innerWidth <= 991) {
                horizContainer.style.transform = 'none';
                const cards = horizContainer.querySelectorAll('.about-card');
                cards.forEach(card => card.style.transform = 'none');
                return;
            }
            const sectionTop = horizSection.offsetTop;
            const sectionHeight = horizSection.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollY = window.scrollY;

            // Calculate how far we've scrolled into the section
            const maxScroll = sectionHeight - windowHeight;
            const scrollDistance = scrollY - sectionTop;
            
            // Normalize progress between 0 and 1
            let progress = scrollDistance / maxScroll;
            if (progress < 0) progress = 0;
            if (progress > 1) progress = 1;

            // Calculate max translation
            // The container's full width minus the viewport width
            const maxTranslate = horizContainer.scrollWidth - window.innerWidth;
            
            if (maxTranslate > 0) {
                const translateX = -(progress * maxTranslate);
                horizContainer.style.transform = `translateX(${translateX}px)`;
                
                // Scale cards based on proximity to center
                const cards = horizContainer.querySelectorAll('.about-card');
                const windowCenter = window.innerWidth / 2;
                
                cards.forEach(card => {
                    const rect = card.getBoundingClientRect();
                    const cardCenter = rect.left + (rect.width / 2);
                    const distFromCenter = Math.abs(windowCenter - cardCenter);
                    
                    const threshold = window.innerWidth / 2;
                    let scale = 1.1 - (distFromCenter / threshold) * 0.15;
                    if (scale < 0.95) scale = 0.95;
                    if (scale > 1.1) scale = 1.1;
                    
                    card.style.transform = `scale(${scale})`;
                });
            }
        });
    }

    // 8. PRODUCT PAGE SLIDERS (SPLIT LAYOUT)
    const initSplitSlider = (prefix) => {
        const slider = document.getElementById(`product-slider-${prefix}`);
        const btnPrev = document.getElementById(`ps-prev-${prefix}`);
        const btnNext = document.getElementById(`ps-next-${prefix}`);
        const dots = document.querySelectorAll(`#ps-dots-${prefix} .dot`);
        
        if (slider && btnPrev && btnNext) {
            let currentSlide = 0;
            const totalSlides = slider.children.length;
            const maxSlide = Math.max(0, totalSlides - 2); // Show 2 slides at once

            const updateSlider = () => {
                slider.style.transform = `translateX(-${currentSlide * 50}%)`;
                dots.forEach((dot, idx) => {
                    dot.classList.toggle('active', idx === currentSlide);
                });
            };

            btnNext.addEventListener('click', () => {
                currentSlide = (currentSlide + 1) > maxSlide ? 0 : currentSlide + 1;
                updateSlider();
            });

            btnPrev.addEventListener('click', () => {
                currentSlide = (currentSlide - 1) < 0 ? maxSlide : currentSlide - 1;
                updateSlider();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    if(index <= maxSlide) {
                        currentSlide = index;
                        updateSlider();
                    }
                });
            });
        }
    };

    initSplitSlider('left');
    initSplitSlider('right');

    // 9. PRODUCT ACCORDIONS (DESCRIPTION/NOTES/FAQS)
    const accordions = document.querySelectorAll('.accordion-header, .faq-header');
    accordions.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const isOpen = item.classList.contains('active');
            
            // Close all others in the same group
            const group = header.closest('.product-accordions, .faq-accordion-list');
            if (group) {
                group.querySelectorAll('.accordion-item, .faq-item').forEach(i => {
                    i.classList.remove('active');
                });
            }
            
            // Toggle current
            if (!isOpen) {
                item.classList.add('active');
            }
        });
    });

    // 10. SIMILAR FRAGRANCES CAROUSEL
    const similarTrack = document.getElementById('similar-track');
    const btnSimPrev = document.getElementById('btn-similar-prev');
    const btnSimNext = document.getElementById('btn-similar-next');

    if (similarTrack && btnSimPrev && btnSimNext) {
        const getSimScrollAmount = () => {
            const card = similarTrack.querySelector('.product-card') || similarTrack.querySelector('.similar-card'); // fallback
            if (!card) return 300;
            const gap = parseFloat(window.getComputedStyle(similarTrack).gap) || 0;
            return card.offsetWidth + gap;
        };
        btnSimNext.addEventListener('click', () => {
            similarTrack.scrollBy({ left: getSimScrollAmount(), behavior: 'smooth' });
        });
        btnSimPrev.addEventListener('click', () => {
            similarTrack.scrollBy({ left: -getSimScrollAmount(), behavior: 'smooth' });
        });
    }

    // 11. DYNAMIC FOOTER BLOGS DROPDOWN
    const footerLinks = document.querySelectorAll('.footer-nav .footer-link');
    footerLinks.forEach(link => {
        if (link.textContent.trim() === 'Blogs') {
            const dropdown = document.createElement('div');
            dropdown.className = 'footer-link-dropdown';
            
            const span = document.createElement('span');
            span.className = 'footer-link';
            span.textContent = 'Blogs';
            
            const menu = document.createElement('div');
            menu.className = 'footer-dropdown-menu';
            
            const englishLink = document.createElement('a');
            englishLink.href = 'blogs?lang=en';
            englishLink.textContent = 'English';
            
            const hindiLink = document.createElement('a');
            hindiLink.href = 'blogs?lang=hi';
            hindiLink.textContent = 'Hindi';
            
            menu.appendChild(englishLink);
            menu.appendChild(hindiLink);
            
            dropdown.appendChild(span);
            dropdown.appendChild(menu);
            
            link.parentNode.replaceChild(dropdown, link);
        }
    });

    // 12. DASHBOARD SIDEBAR TOGGLE (MOBILE)
    const sidebarToggle = document.querySelector('.dashboard-sidebar-toggle');
    const dashboardSidebar = document.querySelector('.dashboard-sidebar');

    if (sidebarToggle && dashboardSidebar) {
        // Dynamically inject close button
        const closeBtn = document.createElement('button');
        closeBtn.className = 'dashboard-sidebar-close';
        closeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        dashboardSidebar.insertBefore(closeBtn, dashboardSidebar.firstChild);

        sidebarToggle.addEventListener('click', () => {
            dashboardSidebar.classList.add('sidebar-open');
            sidebarToggle.style.display = 'none';
        });

        closeBtn.addEventListener('click', () => {
            dashboardSidebar.classList.remove('sidebar-open');
            sidebarToggle.style.display = ''; // reset to default inline-flex
        });
    }
});
